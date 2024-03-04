<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Support\Carbon;

class BookingAppointmentController extends Controller
{
    //  return booking appointment page
    public function bookAppointment(){
        $doctor = Doctor::with("specializations","user")->findOrFail(3);
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
        return view("user.book_appointment",compact("doctor","datesFrWTime")); 
    }

    // Create appointment 
    public function createAppointment(Request $request){
        Schedule::create([
            "user_id" => $request->user_id, 
            "patient_id" => $request->patient_id, 
            "doctor_id" => $request->doctor_id, 
            "appointment" => $request->appointment, 
        ]);
        return redirect()->back();
    }
}
