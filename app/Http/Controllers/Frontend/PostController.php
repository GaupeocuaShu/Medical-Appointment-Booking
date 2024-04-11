<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post; 
use App\Models\User;
class PostController extends Controller
{
    public function show($postID){ 
        $post = Post::findOrFail($postID); 
        $creator = $post->user; 
        return view("frontend.pages.news",[
            'post' => $post, 
            'creator' => $creator,
        ]); 
    }

}
