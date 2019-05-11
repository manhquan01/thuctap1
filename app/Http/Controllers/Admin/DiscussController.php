<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscussModel;

class DiscussController extends Controller
{
    public function index()
    {
        $comment = DiscussModel::select('comment', 'created_at', 'post_id', 'user_id')->orderBy('id', 'DESC')->get();
        return view('Admin.Discuss.index', ['comment' => $comment]);
    }
}
