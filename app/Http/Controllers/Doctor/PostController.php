<?php

namespace App\Http\Controllers\Doctor;

use App\DataTables\PostDataTable;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(PostDataTable $dataTable)
    {
        return $dataTable->render('doctor.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("doctor.post.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumb_image' => ['required','image'],
            'title' => ['required'], 
            "short_description" => ['required'],
            "content" => ['required'],
        ]);    
        $path = $this->uploadImage($request,'uploads','thumb_image');
        Post::create([
            'thumb_image' =>  $path,
            'user_id' => Auth::user()->id,
            'title' => $request->title, 
            'short_description' => $request->short_description,
            'content' => $request->content,
        ]);
        Session::flash("status","Create Post Successfully");
        return redirect()->route('doctor.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id); 
        return view("doctor.post.edit",[
            "post" => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id); 
        $request->validate([
            'thumb_image' => ['image'],
            'title' => ['required'], 
            "short_description" => ['required'],
            'content' => ['required'],
        ]);
        $path = $this->updateImage($request,$post->thumb_image,'uploads','thumb_image');
        $post->update([
            'thumb_image' =>  $path ? $path : $post->thumb_image ,
            'user_id' => Auth::user()->id,
            'title' => $request->title, 
            'short_description' => $request->short_description,
            'content' => $request->content,
        ]);
        Session::flash("status","Update Post Successfully");
        return redirect()->route("doctor.post.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response(["status" => "success","message"=>"Delete Post Successfully","is_empty" => isTableEmpty(Post::get())]);
    }
    public function upload(Request $request){
        $path = $this->uploadImage($request,'uploads','upload'); 
        $url = asset($path);
        return response()->json(['fileName' => $path,'uploaded' => 1 ,'url' => $url]);
    }
}
