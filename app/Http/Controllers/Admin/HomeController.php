<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostModel;
use App\CategoriesModel;
use App\Models\DiscussModel;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckRoleUser');
    }

    public function index(Request $request)
    {
        $total_post = PostModel::count();
        $total_posted = PostModel::where('status', '0')->count();
        $total_category = CategoriesModel::count();
        $total_comment = DiscussModel::count();
        $countUser = User::count();
        return view('Admin.dashboard.dashboard', [
            'total_post' => $total_post,
            'total_posted' => $total_posted,
            'total_category' => $total_category,
            'total_comment' => $total_comment,
            'countUser' => $countUser,
        ]);
    }
}
