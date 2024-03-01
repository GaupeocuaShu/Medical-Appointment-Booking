<?php

namespace App\Http\Controllers\admin;

use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Doctor_Specialization;
use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
 
    public function index(DoctorDataTable $doctorDataTable)
    {
        return $doctorDataTable->render("admin.doctor.index");
    }

 
    public function create()
    {
        $users = User::get();
        $specializations = Specialization::get();
        return view("admin.doctor.create",compact("users","specializations"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "academic_degree" => ["required"],
            "experience_year" => ["required"], 
            "title" => ["required"], 
            "user_id" => ["required"], 
            "specialization_id" => ["required"], 
        ]); 
     
        $doctor = Doctor::create([
            "academic_degree"=>$request->academic_degree, 
            "specialization_id"=>$request->specialization_id, 
            "experience_year"=>$request->experience_year, 
            "user_id"=>$request->user_id, 
            "title"=>$request->title, 
            "note"=>$request->note, 
            "introduction"=>$request->introduction, 
            "training_process"=>$request->training_process, 
            "experience_list"=>$request->experience_list, 
            "prize_and_research"=>$request->prize_and_research, 
        ]);
        Doctor_Specialization::create([
            "doctor_id" => $doctor->id, 
            "specialization_id" => $request->specialization_id,
        ]); 
        Session::flash("status","Create Doctor Successfully");
        return redirect()->route("admin.doctor.index");
    }   


    public function show(string $id)
    {   
        $doctor = Doctor::with("specializations","user")->findOrFail($id);
    
        return view("admin.doctor.show",compact());
    }

  
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
