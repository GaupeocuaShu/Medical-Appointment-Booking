<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScheduleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Return canceled data table

    public function canceled(ScheduleDataTable $dataTable){
        return $dataTable->with("status","canceled")->render("admin.schedule.pending_table");
    }

    // Return pending data table

    public function pending(ScheduleDataTable $dataTable){
        return $dataTable->with("status","pending")->render("admin.schedule.pending_table");
    }

    // Return confirmed data table

    public function confirmed(ScheduleDataTable $dataTable){
        return $dataTable->with("status","confirmed")->render("admin.schedule.pending_table");
    }

    // Return completed data table

    public function completed(ScheduleDataTable $dataTable){
        return $dataTable->with("status","completed")->render("admin.schedule.pending_table");
    } 
}
