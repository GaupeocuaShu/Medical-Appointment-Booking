<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render("admin.user.index"); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);
        return view("admin.user.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "avatar" => ["image"],
        ]);
        $user = User::findOrFail($id);
        $avatar = $this->updateImage($request,$user->avatar,"uploads","avatar");
        $user->update([
            "first_name" => $request->first_name, 
            "last_name" => $request->last_name, 
            "middle_name" => $request->middle_name, 
            "date_of_birth" => $request->date_of_birth, 
            "gender" => $request->gender, 
            "status" => $request->status, 
            "role" => $request->role, 
            "address" => $request->address, 
            "phone" => $request->phone, 
            "description" => $request->description, 
            "role" => $request->role, 
            "email" => $request->role, 
            "avatar" =>  $avatar,
        ]);
        Session::flash("status","Update User Successfully");
        return redirect()->route("admin.user.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateRole(Request $request,string $id){
        $user = User::findOrFail($id); 
        $user->update([
            "role" => $request->key
        ]);
        return response(["status" => "success_show","text" => "Update Role Successfully"]);
    }
}
