<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.index', compact('posts'));
    }

    public function table()
    {
        $users = User::all();

        return view('admin.table', compact('users'));
    }
}
