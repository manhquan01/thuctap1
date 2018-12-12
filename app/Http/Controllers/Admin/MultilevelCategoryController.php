<?php

namespace App\Http\Controllers\Admin;

use App\CategoriesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MultilevelCategoryController extends Controller
{
    public function index()
    {
        $menu = CategoriesModel::all();
        return view('multilevel_category',['menu' => $menu]);
    }

    public function store(Request $request)
    {
        $category_model = new CategoriesModel();
        $category_model->cate_name = $request->cate_name;
        $category_model->cate_slug = $request->cate_slug;
        $category_model->cate_parent = $request->cate_parent;
        $category_model->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $cate = CategoriesModel::find($id);
        return $cate;
    }

    public function update(Request $request)
    {
        $category_model = CategoriesModel::find($request->cate_id);
        $category_model->cate_name = $request->cate_name;
        $category_model->cate_slug = $request->cate_slug;
        $category_model->cate_parent = $request->cate_parent;
        $category_model->save();
        return $category_model;
    }

    public function parent($id)
    {
        $parent = CategoriesModel::where('id','!=', $id)->get();
        return $parent;
    }
}
