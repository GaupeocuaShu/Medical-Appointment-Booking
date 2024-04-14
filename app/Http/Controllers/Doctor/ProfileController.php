<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Workplace;
use App\Models\Specialization;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;
class ProfileController extends Controller
{
    use UploadTrait;
    public function index(){
        $user  = Auth::user();
        $doctor = $user->doctor; 
        $firstName = $user->first_name; 
        $middleName = $user->middle_name; 
        $lastName = $user->last_name; 
        $specializations = Specialization::get();
        $workplaces = Workplace::get();

        return view("doctor.profile.index",[ 
            "fullName" => $lastName." ".$middleName." ".$firstName,
            "user" => $user,  
            "doctor" => $doctor,  
            "firstName" => $firstName, 
            "middleName" => $middleName, 
            "lastName" => $lastName, 
            "specializations" => $specializations,
            "workplaces" => $workplaces,

        ]);
    }
    public function profileUpdate(Request $request){
     
        $user = Auth::user(); 
        
        $path = $this->updateImage($request,$user->avatar,"uploads","avatar");
        $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['email','required'], 
            'phone' => ['required'], 
            'address' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],

        ]);
        $user->update([
            "first_name" => $request->first_name, 
            "middle_name" => $request->middle_name, 
            "last_name" => $request->last_name, 
            "email" => $request->email, 
            "gender" => $request->gender, 
            "phone" => $request->phone, 
            "description" => $request->description,
            "address" => $request->address,
            "date_of_birth" => $request->date_of_birth,
            "avatar" => $path != null ? $path : $user->avatar,
        ]);
        Session::flash("status","Update Profile Successfully");
        return redirect()->back();
    }
    public function passwordUpdate(Request $request){
        $request->validate([
            "current_password" => ["required","current_password"], 
            "password" => ["required","confirmed"], 
        ]); 
        Auth::user()->update([
            "password" => bcrypt($request->password),
        ]);
        Session::flash("status","Update Password Successfully");

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function doctorProfileUpdate(Request $request)
    { 
        $request->validate([
            "academic_degree" => ["required"],
            "experience_year" => ["required"], 
            "title" => ["required"], 
        ]); 
        $doctor = Auth::user()->doctor;
        $doctor->update([
            "academic_degree"=>$request->academic_degree, 
            "experience_year"=>$request->experience_year,
            "workplace_id"=>$request->workplace_id, 
            "title"=>$request->title,
            "note"=>$request->note,
            "introduction"=>$request->introduction,
            "training_process"=>$request->training_process,
            "experience_list"=>$request->experience_list,
            "prize_and_research"=>$request->prize_and_research,
        ]);
        $doctor->specializations()->sync($request->specialization_id);
        Session::flash("status","Update Doctor Profile Successfully");

        return redirect()->back();
    }




    // Get Specialization ID
    public function getSpecialization(){
        $doctor = Auth::user()->doctor;
        $specializationIDs = array();
        foreach($doctor->specializations as $s){
            $specializationIDs[] = $s->id;
        };
        return response($specializationIDs);
    }
}