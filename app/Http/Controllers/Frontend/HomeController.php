<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Post;
class HomeController extends Controller
{
    public function index(){ 
        $doctors = Doctor::with("specializations", "user", "workplace")->take(10)->get();
        $posts = Post::with("user")->take(3)->get();
        return view("frontend.pages.home",compact("doctors","posts"));
    }

    
}
