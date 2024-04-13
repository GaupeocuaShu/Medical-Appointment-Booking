<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostManagementDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostManagementController extends Controller
{
    public function index(PostManagementDataTable $dataTable){
        return $dataTable->render("admin.post.index");
    }

      // Change Status 
      public function changeStatus(string $id){
        $post = Post::findOrFail($id);
        $newStatus = !$post->status; 
        $post->update(["status" =>$newStatus]);
        return response(["status" => "success","message"=>"Change Post Status Successfully"]);
    }
}
