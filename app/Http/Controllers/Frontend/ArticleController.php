<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoriesModel;
use App\Models\PostModel;
use App\Models\DiscussModel;
use DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $posts = array();

        $cate = CategoriesModel::where('status', '1')
            ->get()
            ->toArray();

        $feature = PostModel::orderBy('id', 'DESC')
            ->limit(5)
            ->where('status', '0')
            ->where('featured', '1')
            ->get()
            ->toArray();

        foreach ($cate as $item){
            $post = PostModel::take(4)
                ->orderBy('id', 'DESC')
                ->where('category_id', $item['id'])
                ->where('status', '0')
                ->get()
                ->toArray();
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
        $discuss = DiscussModel::select('comment', 'updated_at', 'user_id')->where('post_id', $post->id)->get();
        return view('Frontend.detail_post', ['post' => $post, 'discuss' => $discuss]);
    }

    public function comment(Request $request){
        $discuss = new DiscussModel;
        $discuss->comment = $request->message;
        $discuss->post_id = $request->id;
        $discuss->user_id = Auth::user()->id;
        $discuss->save();
        return back();
    }

}
