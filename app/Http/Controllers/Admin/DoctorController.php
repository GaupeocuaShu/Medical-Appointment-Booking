<?php

namespace App\Http\Controllers\admin;

use App\DataTables\DoctorDataTable;
use App\DataTables\DoctorScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Doctor_Specialization;
use App\Models\Schedule;
use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workplace;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
 
    public function index(DoctorDataTable $doctorDataTable)
    {
        return $doctorDataTable->render("admin.doctor.index");
    }

 
    public function create()
    {
        $users = User::where('role','!=','doctor')->get();
        $specializations = Specialization::get();
        $workplaces = Workplace::get();
        return view("admin.doctor.create",compact("users","specializations","workplaces"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "academic_degree" => ["required"],
            "experience_year" => ["required"], 
            "user_id" => ["required"], 
            "specialization_id" => ["required"], 
            "workplace_id" => ["required"], 
        ]); 
     
        $doctor = Doctor::create([
            "academic_degree"=>$request->academic_degree, 
            "workplace_id"=>$request->workplace_id, 
            "experience_year"=>$request->experience_year, 
            "user_id"=>$request->user_id, 
            "title"=>$request->title, 
            "note"=>$request->note, 
            "introduction"=>$request->introduction, 
            "training_process"=>$request->training_process, 
            "experience_list"=>$request->experience_list, 
            "prize_and_research"=>$request->prize_and_research, 
        ]);

        $user = $doctor->user;
        $user->update(["role" => "doctor"]);    

        foreach($request->specialization_id as $id){
            $doctor->specializations()->attach($id); 
        }
        Session::flash("status","Create Doctor Successfully");
        return redirect()->route("admin.doctor.index");
    }   

    public function show(string $id)
    {   
        $doctor = Doctor::with("specializations","user","workplace")->findOrFail($id);
        $datesFrWTime = array();
        $timesFrWTime = array();
        $flag = " "; 
        $working_times = $doctor->working_times()->orderBy('working_time')->get();
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
        return view("admin.doctor.show",compact("doctor","datesFrWTime"));
    } 

  
    public function edit(string $id)
    {
     
        $users = User::where('role','!=','doctor')->get(); 
        
        $specializations = Specialization::get();
        $doctor = Doctor::with("specializations")->findOrFail($id); 
        $workplaces = Workplace::get();

        return view("admin.doctor.edit",compact("doctor","users","specializations","workplaces"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 

        $request->validate([
            "academic_degree" => ["required"],
            "experience_year" => ["required"], 
            "user_id" => ["required"], 
        ]); 
        
        $doctor = Doctor::findOrFail($id);
        $oldUID = $doctor->user->id;
        $doctor->update([
            "academic_degree"=>$request->academic_degree, 
            "experience_year"=>$request->experience_year,
            "user_id"=>  $request->user_id,
            "workplace_id"=>$request->workplace_id, 
            "title"=>$request->title,
            "note"=>$request->note,
            "introduction"=>$request->introduction,
            "training_process"=>$request->training_process,
            "experience_list"=>$request->experience_list,
            "prize_and_research"=>$request->prize_and_research,
        ]);
        $doctor->specializations()->sync($request->specialization_id);
        $newUID = $request->user_id; 
        if($oldUID != $newUID) { 
            User::findOrFail($oldUID)->update(['role' => 'user']);
            User::findOrFail($newUID)->update(['role' => 'doctor']);
        }
        Session::flash("status","Update Doctor Successfully");
        
        return redirect()->route("admin.doctor.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);  
        $user = $doctor->user; 
        $user->update(['role' => "user"]);
        $doctor->delete();
        return response(["status"=>"success","message"=>"Delete Doctor successfully","is_empty" => isTableEmpty(Doctor::get())]);
    }
    // Get Specialization ID
    public function getSpecialization(string $id){
        $doctor = Doctor::with("specializations")->findOrFail($id); 
        $specializationIDs = array();
        foreach($doctor->specializations as $s){
            $specializationIDs[] = $s->id;
        };
        return response($specializationIDs);
    }
    // Add Working Time for Doctor
    public function workingTime(string $id){
        $firstOfMonth = Carbon::now()->firstOfMonth();  

        return view("admin.doctor.working-time",compact("firstOfMonth","id"));
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
            "date_of_birth" =>Carbon::create($user->date_of_birth)->isoFormat("DD/MM/YYYY"),
            "schedule_note" => $schedule->note,
            "patient_note" => $user->patient->note,
            "gender" => $user->gender,
            "schedule" => Carbon::create($appointment)->isoFormat("HH:mm DD-MM-YYYY"),
        ]);
    }

}
