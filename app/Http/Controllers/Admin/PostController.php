<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($id)
    {

        return '<h2>DS BÀI VIẾT </h2>';
    }
    public function add()
    {
        dd(Gate::allows('posts.add'));
        return '<h2>thêm bài viết</h2>';
    }
    public function edit($id)
    {

        return '<h2>sửa ' . $id . '</h2>';
    }
}
