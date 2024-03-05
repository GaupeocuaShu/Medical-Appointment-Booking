<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ScheduleController extends Controller
{
    // Return canceled data table

    public function canceled(ScheduleDataTable $dataTable){
        $schedule = "canceled";
        $bookedDates = Schedule::where("status","canceled")->select('appointment')->get();
        $onlyBDates = array();  
        foreach ($bookedDates as $date) {
            $onlyBDates[] = Carbon::create($date->appointment)->toDateString();
        }
        $uniqueBDates = array_unique($onlyBDates);
        return $dataTable->with("status","canceled")->render("admin.schedule.schedule_table",compact("uniqueBDates","schedule"));
    }

    // Return pending data table

    public function pending(ScheduleDataTable $dataTable){
        
        return $dataTable->with("status","pending")->render("admin.schedule.schedule_table");
    }

    // Return confirmed data table

    public function confirmed(ScheduleDataTable $dataTable){
        return $dataTable->with("status","confirmed")->render("admin.schedule.schedule_table");
    }

    // Return completed data table

    public function completed(ScheduleDataTable $dataTable){
        return $dataTable->with("status","completed")->render("admin.schedule.schedule_table");
    } 

    public function checkStatusTableEmpty($status){
        return count(Schedule::where("status",$status)->get()) > 0 ? false : true;
    } 
    // Update schedule status 
    public function updateStatus(Request $request,string $id){ 
        $schedule = Schedule::findOrFail($id);
        $currentStatus = $schedule->status;
        $schedule->update([
            "status" => $request->key,
            "note" => $request->text,
        ]);
        
        $isEmpty = self::checkStatusTableEmpty($currentStatus);
        return response(["status" => "hide","id" => $id,"is_empty" => $isEmpty]);
    }

    // Filter schedule
    public function filterSchedule(){

    }
}
