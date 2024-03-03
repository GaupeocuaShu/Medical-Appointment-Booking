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
    public function getWorkingTime(){
        
    } 
    // Update working time 
    public function updateWorkingTime(Request $request){
        $dateFromRes = Carbon::createFromDate(null,$request->month,$request->day);
        $oldWTimes= WorkingTime::whereDate("working_time",$dateFromRes->toDateString())->get();
        if($oldWTimes->count() > 0) foreach($oldWTimes as $oTime){
            $oTime->delete();
        };
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
