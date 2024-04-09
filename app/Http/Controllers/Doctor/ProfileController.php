<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Workplace;
use App\Models\Specialization;
class ProfileController extends Controller
{
    use UploadTrait;
    public function index(){
        $user  = Auth::user();
        $doctor = $user->doctor; 
        $firstName = $user->first_name; 
        $middleName = $user->middle_name; 
        $lastName = $user->last_name; 
        $datesFrWTime = array();
        $timesFrWTime = array();
        $flag = " "; 
        $working_times = $doctor->working_times()->orderBy('working_time')->get(); 
        $specializations = Specialization::get();
        $workplaces = Workplace::get();
        foreach( $working_times as $wTime){
            $carbonWTime = Carbon::create($wTime->working_time);
            if($flag != $carbonWTime->toDateString() && $flag != " ") {
                $datesFrWTime[$flag] = $timesFrWTime;
                $timesFrWTime = array();
            }
       
            $timesFrWTime[] =$wTime->is_selected == true 
                            ? $carbonWTime->isoFormat("HH:mm")."/b" 
                            :  $carbonWTime->isoFormat("HH:mm");
            $flag = $carbonWTime->toDateString();
            if(!next($doctor->working_times)){
                $datesFrWTime[$flag] = $timesFrWTime;
            }
        }
        return view("doctor.profile.index",[ 
            "fullName" => $lastName." ".$middleName." ".$firstName,
            "user" => $user,  
            "doctor" => $doctor,  
            "firstName" => $firstName, 
            "middleName" => $middleName, 
            "lastName" => $lastName, 
            "datesFrWTime" => $datesFrWTime,
            "specializations" => $specializations,
            "workplaces" => $workplaces,

        ]);
    }
    public function profileUpdate(Request $request){
     
        $user = Auth::user(); 
        $path = $this->updateImage($request,$user->avatar,"uploads","avatar");
        $user->update([
            "first_name" => $request->first_name, 
            "middle_name" => $request->middle_name, 
            "last_name" => $request->last_name, 
            "email" => $request->email, 
            "gender" => $request->gender, 
            "phone" => $request->phone, 
            "description" => $request->description,
            "address" => $request->address,
            "avatar" => $path != null ? $path : $user->avatar,
        ]);
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
            "user_id" => ["required"], 
        ]); 
        $doctor = Auth::user()->doctor;
        $doctor->update([
            "academic_degree"=>$request->academic_degree, 
            "experience_year"=>$request->experience_year,
            "user_id"=>$request->user_id,
            "workplace_id"=>$request->workplace_id, 
            "title"=>$request->title,
            "note"=>$request->note,
            "introduction"=>$request->introduction,
            "training_process"=>$request->training_process,
            "experience_list"=>$request->experience_list,
            "prize_and_research"=>$request->prize_and_research,
        ]);
        $doctor->specializations()->sync($request->specialization_id);
        return redirect()->route("admin.doctor.index");
    }

    
    // Get Doctor Working Time 
    public function getWorkingTime(Request $request){
        $dateTime = $request->date.$request->time;
        $appointment = Carbon::create($dateTime);
        $schedule = Schedule::where("doctor_id",$request->doctor_id)->where("appointment",$appointment)->first();
        $user = $schedule->user;
        return response([
            "url" => route("admin.schedule.show",$schedule->id),
            "name" =>getFullName($user),
            "date_of_birth" =>$user->date_of_birth,
            "schedule_note" => $schedule->note,
            "patient_note" => $user->patient->note,
            "gender" => $user->gender,
            "schedule" => Carbon::create($appointment)->isoFormat("HH:mm DD-MM-YYYY"),
        ]);
    }
}