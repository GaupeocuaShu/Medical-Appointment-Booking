<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule; 
use App\DataTables\DoctorScheduleDataTable;
use Illuminate\Support\Carbon;
use App\Models\User;
class ScheduleController extends Controller
{
   // Get Unique Booked Dates
   public function getUniqueBDates($id){
        $bookedDates = Schedule::where("doctor_id",$id)->select('appointment')->get();
        $onlyBDates = array();  
        foreach ($bookedDates as $date) {
            $onlyBDates[] = Carbon::create($date->appointment)->toDateString();
        }
        return array_unique($onlyBDates);
    }

    public function index(DoctorScheduleDataTable $dataTable){ 
        $user = auth()->user();
        $id = $user->doctor->id;
        $uniqueBDates = self::getUniqueBDates($id);
        $user = $user;
        return $dataTable->with("id",$id)->render("doctor.schedule.index",compact("uniqueBDates","user"));
    }
    // Show 
    public function show(string $id){
        $schedule =  Schedule::findOrFail($id);
        $userID = $schedule->user_id;
        $doctor = auth()->user();
        $user = User::with("patient")->findOrFail($userID);
        return view("doctor.schedule.show",compact("schedule","user","doctor"));
    }    
}
