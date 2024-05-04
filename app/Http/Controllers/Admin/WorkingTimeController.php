<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\WorkingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class WorkingTimeController extends Controller
{
    // Get working time
    public function getWorkingTime(Request $request){ 
        $doctorID = $request->doctor_id;
        $workingTimes = array();
        $timeStrings = array();
        $daysInMonth = Carbon::now()->daysInMonth;
        $currentMonth = Carbon::now()->month;
        for($i = 1 ; $i <= $daysInMonth ; $i++){
            $workingTimesFromDB = WorkingTime::whereMonth("working_time",$currentMonth)->where("select_id",$i)->where('doctor_id',$doctorID)->get(); 
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
        $doctorID = $request->doctor_id;
        $dateFromRes = Carbon::createFromDate(null,$request->month,$request->day);
        $oldWTimes= WorkingTime::where('doctor_id',$doctorID)->whereDate("working_time",$dateFromRes->toDateString())->get();
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
