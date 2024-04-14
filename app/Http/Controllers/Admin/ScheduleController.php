<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\WorkingTime;

class ScheduleController extends Controller
{
    // Show 
    public function show(string $id){
        $schedule =  Schedule::findOrFail($id);
        $userID = $schedule->user_id;
        $doctorUID = $schedule->doctor->user->id;
        $doctor = User::with("doctor")->findOrFail($doctorUID);
        $user = User::with("patient")->findOrFail($userID);
       
        return view("admin.schedule.show",compact("schedule","user","doctor"));
    }
    // Get Unique Booked Dates
    public function getUniqueBDates($schedule){
        $bookedDates = Schedule::where("status",$schedule)->select('appointment')->get();
        $onlyBDates = array();  
        foreach ($bookedDates as $date) {
            $onlyBDates[] = Carbon::create($date->appointment)->toDateString();
        }
        return array_unique($onlyBDates);
    }
    // Return canceled data table

    public function canceled(ScheduleDataTable $dataTable){
        $uniqueBDates = self::getUniqueBDates("canceled");
        return $dataTable->with("status","canceled")->render("admin.schedule.index",compact("uniqueBDates"));
    }

    // Return pending data table

    public function pending(ScheduleDataTable $dataTable){
        $uniqueBDates = self::getUniqueBDates("pending");
        return $dataTable->with("status","pending")->render("admin.schedule.index",compact("uniqueBDates"));
    }

    // Return confirmed data table

    public function confirmed(ScheduleDataTable $dataTable){
        $uniqueBDates = self::getUniqueBDates("confirmed");
        return $dataTable->with("status","confirmed")->render("admin.schedule.index",compact("uniqueBDates"));
    }

    // Return completed data table

    public function completed(ScheduleDataTable $dataTable){
        $uniqueBDates = self::getUniqueBDates("completed");
        return $dataTable->with("status","completed")->render("admin.schedule.index",compact("uniqueBDates"));
    } 

    public function checkStatusTableEmpty($status){
        return count(Schedule::where("status",$status)->get()) > 0 ? false : true;
    } 
    // Update schedule status 
    public function updateStatus(Request $request,string $id){  
        $newStatus =  $request->key; 
        $schedule = Schedule::findOrFail($id);
        if($newStatus == 'canceled') {
            $wTime = WorkingTime::where('doctor_id',$schedule->doctor_id)->where("working_time",$schedule->appointment)->first();
            $wTime->update(['is_selected' => 0]);
        }
        $currentStatus = $schedule->status;
        $schedule->update([
            "status" => $newStatus,
            "note" => $request->text,
        ]);
        $isEmpty = self::checkStatusTableEmpty($currentStatus);
        return response(["status" => "hide","id" => $id,"is_empty" => $isEmpty]);
    }
}
