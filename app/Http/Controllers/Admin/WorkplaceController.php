<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WorkplaceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Workplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class WorkplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WorkplaceDataTable $dataTable)
    {   
        return $dataTable->render("admin.workplace.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.workplace.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required"], 
            "address" => ["required"],
            "city" => ["required"], 
            "province" => ["required"],
        ]); 
        Workplace::create([
            "name" => $request->name, 
            "address" => $request->address, 
            "city" => $request->city, 
            "province" => $request->province,
            "status" => $request->status,
        ]); 
        Session::flash("status","Create workplace Successfully");
        return redirect()->route("admin.workplace.index");
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
        $wp = Workplace::findOrFail($id);
        return view("admin.workplace.edit",compact("wp"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => ["required"], 
            "address" => ["required"],
            "city" => ["required"], 
            "province" => ["required"],
        ]); 
        $workplace = Workplace::findOrFail($id);
        $workplace->update($request->all());
        Session::flash("status","Update Workplace Successfully");
        return redirect()->route("admin.workplace.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workplace = Workplace::findOrFail($id);
        $workplace->delete();
        return response(["status" => "success","message"=>"Delete workplace Successfully","is_empty" => isTableEmpty(Workplace::get())]);
    }

    // Change Status 
    public function changeStatus(string $id){
        $workplace = Workplace::findOrFail($id);
        $newStatus = !$workplace->status; 
        $workplace->update(["status" =>$newStatus]);
        return response(["status" => "success","message"=>"Change workplace Status Successfully"]);
    }
}
