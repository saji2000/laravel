<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function createPost(Request $request){
        if (!auth()->check()) {
            return redirect('/')->with('error', 'You must be logged in to create a post.');
        }

        $incomingFields = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'body' => ['required', 'min:3', 'max:1000']
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        try {
            $post = Post::create($incomingFields);
            error_log("Post created id={$post->id} user_id={$post->user_id} title={$post->title}");
            Log::info('PostController:createPost — post created', ['post_id' => $post->id, 'user_id' => $post->user_id, 'title' => $post->title]);
            return redirect('/')->with('success', 'Post created!');
        } catch (\Exception $e) {
            error_log("Post creation failed: " . $e->getMessage());
            return redirect('/')->with('error', 'Post creation failed: ' . $e->getMessage());
        }
    }

    public function editPostForm(Post $post){
        if (auth()->id() !== $post->user_id){
            return redirect('/')->with('error', 'You do not have permission to edit this post.');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Request $request, Post $post){
        if (auth()->id() !== $post->user_id){
            return redirect('/')->with('error', 'You do not have permission to edit this post.');
        }
        $incomingFields = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'body' => ['required', 'min:3', 'max:1000']
        ]); 

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $post->update($incomingFields);
        return redirect('/')->with('success', 'Post updated!');
    }

}
