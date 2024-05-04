<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Schedule;
use App\Models\WorkingTime;
class WorkingtimeController extends Controller
{
    public function index(){
        $doctor = Auth::user()->doctor;
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
        return view("doctor.working-time.index",[
            "datesFrWTime" =>  $datesFrWTime, 
            "doctor" => auth()->user()->doctor,
        ]);
    }

    // Edit Doctor Working Time 
    public function edit(){
        $firstOfMonth = Carbon::now()->firstOfMonth();  
        $id = Auth::user()->doctor->id;
        return view("doctor.working-time.edit",compact("firstOfMonth","id"));
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
    
    // Get Doctor Working Time For Edit

    public function getWorkingTimeForEdit(){
        $workingTimes = array();
        $timeStrings = array();
        $daysInMonth = Carbon::now()->daysInMonth; 
        $currentMonth = Carbon::now()->month;
        for($i = 1 ; $i <= $daysInMonth ; $i++){
            $workingTimesFromDB = WorkingTime::whereMonth("working_time",$currentMonth)->where("select_id",$i)->where('doctor_id',auth()->user()->doctor->id)->get(); 
            if($workingTimesFromDB->count() > 0){
                foreach ($workingTimesFromDB as $key => $wTime) {
                    $time = Carbon::create($wTime->working_time);
                    $hour = $time->hour;
                    $minute = $time->minute; 
                    $timeStrings[] = $hour."-".$minute;
                }
            }
            if(!empty($timeStrings)) $workingTimes[$i]= $timeStrings;
            $timeStrings=[];
        }
        return response($workingTimes);
    } 
    // Delete working time
    public function deleteWorkingTime($oldWTimes){
        foreach($oldWTimes as $oTime){
            $oTime->delete();
        };
    }
    // Update working time 
    public function updateWorkingTime(Request $request){
        $dateFromRes = Carbon::createFromDate(null,$request->month,$request->day);
        $oldWTimes= WorkingTime::where('doctor_id',auth()->user()->doctor->id)->whereDate("working_time",$dateFromRes->toDateString())->get();
        if($oldWTimes->count() > 0 || empty($request->working_time)) self::deleteWorkingTime($oldWTimes);
        
        if(empty($request->working_time)) {
            return response(["status" => "success","message" => "Update Working Time Successfully"]);
        }

        // Add working time into DB 
        foreach($request->working_time as $time){
            $hour = explode("-",$time)[0]; 
            $minute = explode("-",$time)[1]; 
            $fullWTime = Carbon::create(null,$request->month,$request->day,$hour,$minute);

            WorkingTime::create([
                "doctor_id" => $request->doctor_id, 
                "working_time" =>$fullWTime,
                "select_id" =>$request->select_id,
            ]);
        };
        
        return response(["status" => "success","message" => "Update Working Time Successfully"]);
    }    
}
