<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\WorkingTime;
use Illuminate\Support\Carbon;

class BookingAppointmentController extends Controller
{
    //  return booking appointment page
    public function bookAppointment(string $id){
        $doctor = Doctor::with("specializations","user")->findOrFail($id);
        $datesFrWTime = array();
        $timesFrWTime = array();
        $flag = " ";
        foreach($doctor->working_times as $wTime){
            $carbonWTime = Carbon::create($wTime->working_time);
            if($flag != $carbonWTime->toDateString() && $flag != " ") {
                $datesFrWTime[$flag] = $timesFrWTime;
                $timesFrWTime = array();
            }
            $timesFrWTime[] = $carbonWTime->isoFormat("HH:mm");
            $flag = $carbonWTime->toDateString();
            if(!next($doctor->working_times)){
                $datesFrWTime[$flag] = $timesFrWTime;
            }
        }
        return view("frontend.pages.choose-date",compact("doctor","datesFrWTime")); 
    }

    // Create appointment 
    public function createAppointment(Request $request){
        $schedule = Schedule::create([
            "user_id" => $request->user_id, 
            "patient_id" => $request->patient_id, 
            "doctor_id" => $request->doctor_id, 
            "appointment" => $request->appointment, 
        ]);
        $workingTime = WorkingTime::where("doctor_id",$schedule->doctor_id)
        ->where("working_time",$schedule->appointment);
        $workingTime->update(["is_selected" => true]);
        return redirect()->back();
    }
}
