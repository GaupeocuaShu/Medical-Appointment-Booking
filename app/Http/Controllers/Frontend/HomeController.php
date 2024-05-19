<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Post;
use App\Models\Specialization;

class HomeController extends Controller
{
    public function index(){ 
        $doctors = Doctor::with("specializations", "user", "workplace")->take(10)->get();
        $posts = Post::with("user")->where("status","active")->take(10)->get(); 
        $specializations = Specialization::where("status",true)->take(10)->get(); 
        return view("frontend.pages.home",compact("doctors","posts","specializations"));
    }

    public function doctorTeam(){
        $doctors = Doctor::with("specializations", "user", "workplace")->take(10)->get();
        return view("frontend.pages.doctor-list",compact("doctors"));
    } 

    public function newsList(){ 
        $posts = Post::paginate(10);
        return view('frontend.pages.news-list',compact('posts'));
    }
    public function specialzationList(){
        $specializations = Specialization::where("status",true)->take(10)->get(); 
        return view("frontend.pages.specialization-list",compact("specializations"));
    } 
    public function specialzationBook(string $id){ 
        $specialization = Specialization::findOrFail($id);
        $doctors = Doctor::with("specializations", "user", "workplace") 
        ->whereHas("specializations",function ($query) use ($id) {
            $query->where("specialization_id",$id);
        })
        ->take(10)
        ->get(); 
        return view("frontend.pages.specialization-book",compact("doctors","specialization"));
    }
}
