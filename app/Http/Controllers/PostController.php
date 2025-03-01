<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'content' => 'required'
        ]);

        return Post::create($request->all());
    }

    public function show(Post $post)
    {
        return $post->load('user');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post->update($request->all());
        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
    public function showPosts()
{
    $posts = \App\Models\Post::with('user')->get();
    return view('posts', compact('posts'));
}

}

