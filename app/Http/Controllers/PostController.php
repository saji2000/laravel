<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'body' => ['required', 'min:3', 'max:1000']
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);

        return redirect('/')->with('success', 'Post created!');
    }
}
