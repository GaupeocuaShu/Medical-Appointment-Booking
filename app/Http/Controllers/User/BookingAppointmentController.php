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
    // Get Time Frame By Date 
    public function getTimeFrameByDate(Request $request){
        $date = $request->current_year."-".$request->current_month."-".$request->selected_date;
        $dateFrames = WorkingTime::where("doctor_id",$request->doctor_id)
                    ->whereDate("working_time",$date) 
                    ->where('is_selected',false)
                    ->get("working_time");  
        
        $timeFrames = array(); 
        foreach ($dateFrames as $key => $value) {
            $time = Carbon::create($value->working_time);
            $sTime = $time->isoFormat("HH:mm"); 
            $eTime = $time->addMinute(30)->isoFormat("HH:mm");
            $timeFrames[] = $sTime."-".$eTime;
        }
        return response(["time_frames" => $timeFrames]);
    }
    //  return booking appointment page 
    public function bookAppointment(string $id){
        $doctor = Doctor::with("specializations","user")->findOrFail($id);  
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $datesFrWTime = array();
        $timesFrWTime = array();
        $flag = " ";
        $working_times = WorkingTime::where("doctor_id",$doctor->id)
                        ->whereYear('working_time',$currentYear) 
                        ->whereMonth('working_time',$currentMonth)  
                        ->get();
        foreach( $working_times as $wTime){  

            // $carbonWTime = Carbon::create($wTime->working_time);
            // if($flag != $carbonWTime->toDateString() && $flag != " ") {
            //     $datesFrWTime[$flag] = $timesFrWTime;
            //     $timesFrWTime = array();
            // }
            // $timesFrWTime[] = $carbonWTime->isoFormat("HH:mm");
            // $flag = $carbonWTime->toDateString();
            // if(!next($doctor->working_times)){
            //     $datesFrWTime[$flag] = $timesFrWTime;
            // } 
            if($wTime->is_selected == false){
                $day = Carbon::create($wTime->working_time)->isoFormat("D");  
                $datesFrWTime[$day] = true ; 
            }
        } 
        $jsonDatesFrWTime = json_encode($datesFrWTime);
        return view("frontend.pages.choose-date",compact("doctor","jsonDatesFrWTime"
        ,"currentYear","currentMonth")); 
    }

    // Create appointment 
    public function createAppointment(Request $request){ 
        try{
            [$year,$month,$day,$time] = explode("/",$request->appointment); 
            [$hour,$minute] = explode(":",$time);
            $appointment = Carbon::create($year,$month,$day,$hour,$minute); 
            $schedule = Schedule::create([
                "user_id" => auth()->user()->id, 
                "patient_id" => auth()->user()->patient->patient_id, 
                "doctor_id" => $request->doctor_id, 
                "appointment" => $appointment, 
            ]);
            $workingTime = WorkingTime::where("doctor_id",$schedule->doctor_id)
            ->where("working_time",$schedule->appointment);
            $workingTime->update(["is_selected" => true]);
            return response([
                "status" => "success", 
                "url" => route('booking-success',$schedule->id),
            ]);
        }catch (\Exception $e) {
            // If an exception occurs (e.g., user not found), handle it here
            return response([
                "status" => "fail", 
                
            ]);
        }
    }
    // Return view booking success
    public function bookingSuccess(string $id){ 
        $schedule = Schedule::findOrFail($id);  
        $user = auth()->user();
        $doctor = Doctor::with("workplace","user")->findOrFail($schedule->doctor_id);
        return view("frontend.pages.booking-success",[
            "schedule" => $schedule, 
            "user" => $user,
            "doctor" =>  $doctor,
        ]);
    }
}
