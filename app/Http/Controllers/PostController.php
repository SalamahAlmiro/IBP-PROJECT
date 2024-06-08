<?php

namespace App\Http\Controllers;

use function Laravel\Prompts\search;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);

    }

    public function create()
    {
        if (!auth()->check()) {
            return to_route('login');
        }
        return view('posts.create');
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'title' =>['required', 'min:5', 'max:50'],
            'content' => ['required', 'min:5'],
        ]);
        $validated['user_id'] = auth()->id();

        Post::create($validated);
        return to_route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('posts.edit',['post' => $post] );     
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:5'], 
        ]);
        $post->update($validated);
        return to_route('posts.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();
        return to_route('posts.index');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = Post::where('title', 'like', "%$search%")->get();

        return view('posts.index', ['posts' => $results]);
    }
}
