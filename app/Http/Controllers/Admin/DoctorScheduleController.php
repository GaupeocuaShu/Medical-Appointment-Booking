<?php

namespace App\Http\Controllers\admin;

use App\DataTables\DoctorScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Carbon;
class DoctorScheduleController extends Controller
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
    public function index(DoctorScheduleDataTable $dataTable,string $id){ 
        $uniqueBDates = self::getUniqueBDates($id);
        $user = Doctor::findOrFail($id)->user;
        return $dataTable->with("id",$id)->render("admin.doctor.schedule.index",compact("uniqueBDates","user"));
    }
}
