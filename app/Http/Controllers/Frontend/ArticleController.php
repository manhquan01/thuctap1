<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoriesModel;
use App\Models\PostModel;

class ArticleController extends Controller
{
    public function index()
    {
        $posts = array();
        $cate = CategoriesModel::all()->toArray();
        $feature = PostModel::orderBy('id', 'DESC')->limit(5)->where('status', '0')->where('featured', '1')->get()->toArray();

        foreach ($cate as $item){
            $post = PostModel::take(4)->orderBy('id', 'DESC')->where('category_id', $item['id'])->get()->toArray();
            $posts[] = $post;
        }

        return view('Frontend.home', ['posts' => $posts, 'feature' => $feature]);
    }

    public function showPostOfCategory(Request $request, $slug)
    {
        $cate = CategoriesModel::where('cate_slug', $slug)->first()->toArray();

        $data = PostModel::orderBy('id', 'DESC')->where('category_id', $cate['id'])->where('status', '0')->paginate(10);
        return view('Frontend.category_article', ['data' => $data]);
    }

    public function showArticle(Request $request)
    {
        $post = PostModel::where('slug', $request->slug)->firstOrFail();
        return view('Frontend.detail_post', ['post' => $post]);
    }


}
