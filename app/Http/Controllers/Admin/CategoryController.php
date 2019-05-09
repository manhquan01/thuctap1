<?php

namespace App\Http\Controllers\Admin;

use App\CategoriesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['CheckRoleEditor','CheckRoleUser']);
    }

    private $status = array('hidden', 'show');

    public function index()
    {
        $menu = CategoriesModel::orderBy('id', 'desc')->get();
        $stt = count($menu);
        return view('Admin.Category.category', ['menu' => $menu, 'stt' => $stt]);
    }

    public function store(Request $request)
    {
        $categories_model = new CategoriesModel();
        $categories_model->cate_name = $request->cate_name;
        if ($request->cate_slug != '')
        {
            $categories_model->cate_slug = $request->cate_slug;
        } else{
            $categories_model->cate_slug = $this->vn_to_str($request->cate_name);
        }
        $categories_model->status = '0';
        $categories_model->save();
        return $categories_model;
    }

    public function update(Request $request)
    {
        $categories_model = CategoriesModel::find($request->cate_id);
        $categories_model->cate_name = $request->cate_name;
        if ($request->cate_slug != '')
        {
            $categories_model->cate_slug = $request->cate_slug;
        } else{
            $categories_model->cate_slug = $this->vn_to_str($request->cate_name);
        }
        $categories_model->save();
        return $categories_model;
    }

    public function delete(Request $request)
    {
        $find_post = CategoriesModel::find($request->id)->post()->withTrashed()->get()->first();
        if ($find_post == NULL)
        {
            return CategoriesModel::destroy($request->id);
        }else {
            return 'Can\'t delete this category because exist post in category.';
        }

    }

    public function change_status(Request $request){
        $category =  CategoriesModel::find($request->id);
        if ($request->val == 0){
            $category->status = "1";
        }
        else{
            $category->status = "0";
        }
        $category->save();
        return $category->status;
    }

    function vn_to_str ($str){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni)
        {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ','-',$str);

        return $str;

    }
}
