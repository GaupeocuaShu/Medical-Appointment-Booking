<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SpecializationsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class SpecializationController extends Controller
{
    use UploadTrait;
    public function index(SpecializationsDataTable $datatable)
    {
        return $datatable->render("admin.specialization.index"); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.specialization.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required"], 
            "image" => ["image"],
            "description" => ["required"], 
            "status" => ["required"],
        ]); 
        $path = $this->uploadImage($request,"uploads","image"); 
        Specialization::create([
            "image" => $path,
            "name" => $request->name, 
            "description" => $request->description, 
            "status" => $request->status,
        ]); 
        Session::flash("status","Create Specialization Successfully");
        return redirect()->route("admin.specialization.index");
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
        $specialization = Specialization::findOrFail($id);
        return view("admin.specialization.edit",compact("specialization"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $specialization = Specialization::findOrFail($id);
        $request->validate([
            "name" => ["required"], 
            "image" => ["image"],
            "description" => ["required"], 
            "status" => ["required"],
        ]); 
        $path = $this->updateImage($request,$specialization->image,"uploads","image");
        $specialization->update([
            "name" => $request->name, 
            "description" => $request->description, 
            "status" => $request->status, 
            "image" => $path ? $path : $specialization->image,
        ]);
        Session::flash("status","Update Specialization Successfully");

        return redirect()->route("admin.specialization.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->delete();
        return response(["status" => "success","message"=>"Delete Specialization Successfully","is_empty" => isTableEmpty(Specialization::get())]);
    }

    // Change Status 
    public function changeStatus(string $id){
        $specialization = Specialization::findOrFail($id);
        $newStatus = !$specialization->status; 
        $specialization->update(["status" =>$newStatus]);
        return response(["status" => "success","message"=>"Change Specialization Status Successfully"]);
    }


}
