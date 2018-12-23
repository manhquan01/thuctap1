<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostModel;
use App\CategoriesModel;

class HomeController extends Controller
{
    public function index()
    {
        $total_post = PostModel::all()->count();
        $total_posted = PostModel::where('status', '0')->count();
        $total_category = CategoriesModel::all()->count();
        return view('Admin.dashboard.dashboard', [
            'total_post' => $total_post,
            'total_posted' => $total_posted,
            'total_category' => $total_category,
        ]);
    }
}
