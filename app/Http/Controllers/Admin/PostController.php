<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoriesModel;
use App\Models\PostModel;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public $status_post;

    public function __construct(StatusTicket $statusTicket)
    {
        $this->status_post = $statusTicket->status_post();
    }

    public function index()
    {
        $all_post = PostModel::paginate(10);
        return view('Admin.Post.show',
            ['all_post' => $all_post,
            'status_post' => $this->status_post ]);
    }

    public function create()
    {
        $all_cate = CategoriesModel::all()->toArray();
        return view('Admin.Post.add_post', ['all_cate' => $all_cate]);
    }

    public function store(Request $request)
    {
        $post_model = new PostModel();
        $post_model->title = $request->title;
        if ($request->static_link != '')
        {
            $post_model->slug = $request->static_link;
        } else{
            $post_model->slug = $this->vn_to_str($request->title);
        }

        $post_model->category_id = $request->category;
        $post_model->content = $request->descript;
        $post_model->thumbnail = $request->thumbnail;
        $post_model->author = Auth::user()->id;
        $post_model->status = $request->status;
        $post_model->save();
        return redirect()->route('post_dashboard');
    }

    public function edit($id)
    {
        $post = PostModel::withTrashed()->find($id);
        $all_cate = CategoriesModel::all()->toArray();
        return view('Admin.Post.edit_post',
            ['all_cate' => $all_cate,
            'post' => $post ]);
    }

    public function update(Request $request, $id)
    {
        $post_model = PostModel::find($id);
        $post_model->title = $request->title;
        if ($request->static_link != '')
        {
            $post_model->slug = $request->static_link;
        } else{
            $post_model->slug = $this->vn_to_str($request->title);
        }

        $post_model->category_id = $request->category;
        $post_model->content = $request->descript;
        $post_model->thumbnail = $request->thumbnail;
        $post_model->author = Auth::user()->id;
        $post_model->status = $request->status;
        $post_model->save();
        return redirect()->route('post_dashboard');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        PostModel::whereIn('id', $id)->update(['status' => '1']);
        PostModel::whereIn('id', $id)->delete();
        return redirect()->route('post_dashboard')->with(['success' => 'The select article has been destroyed']);
    }

    public function trash()
    {
        $all_post = PostModel::onlyTrashed()->paginate(10);
        return view('Admin.Post.trash',
            ['all_post' => $all_post,
                'status_post' => $this->status_post ]);
    }

    public function restore(Request $request)
    {
        $id = $request->id;
        PostModel::onlyTrashed()->whereIn('id', $id)->update(['status' => '2']);
        PostModel::onlyTrashed()->whereIn('id', $id)->restore();
        return redirect()->route('trash_post')->with(['success' => 'The select article has been restored']);

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        PostModel::onlyTrashed()->whereIn('id', $id)->forceDelete();
        return redirect()->route('trash_post')->with(['success' => 'The select article has been deleted']);
    }

    public function posted(Request $request)
    {
        $id = $request->id;
        PostModel::whereIn('id', $id)->update(['status' => '0']);
        return redirect()->route('post_dashboard')->with(['success' => 'The select article has been posted']);
    }

    public function search(Request $request)
    {
        $keyword = $request->key_word;
        $all_post = PostModel::where('title', 'LIKE', '%'.$keyword.'%')->get();
        return view('Admin.Post.search_result',
            ['all_post' => $all_post,
                'status_post' => $this->status_post ]);
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

class StatusTicket
{
    private $status_post = array(
        '0' => 'Posted',
        '1' => 'Delete',
        '2' => 'Draft',
    );

    public function status_post()
    {
        return $this->status_post;
    }

}
