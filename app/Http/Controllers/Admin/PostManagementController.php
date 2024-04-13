<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostManagementDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Traits\UploadTrait;

class PostManagementController extends Controller
{
    use UploadTrait;
    public function index(PostManagementDataTable $dataTable){
        return $dataTable->render("admin.post.index");
    }

    public function show(string $id){
        $post = Post::findOrFail($id);
        return view("admin.post.show",[
            "post" => $post,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $this->deleteImage($post->thumb_image);
        $post->delete();
        return response(["status" => "success","message"=>"Delete Post Successfully","is_empty" => isTableEmpty(Post::get())]);
    }
    // Change Status 
    public function changeStatus(string $id){
        $post = Post::findOrFail($id);
        $status = $post->status; 
        if($status == 'pending' || $status == 'inactive') $post->update(["status" =>"active"]);
        else $post->update(["status" =>"inactive"]);
        return response(["status" => "success","message"=>"Change Post Status Successfully"]);
    }
}
