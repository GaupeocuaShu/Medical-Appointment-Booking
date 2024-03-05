<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\admin\WorkingTimeController;
use Illuminate\Support\Facades\Route;

// Dashboard  ------------------------------------
Route::get("dashboard",[DashboardController::class,"index"])->name("dashboard");
// Dashboard  ---------------------------------------


// Profile  ------------------------------------------
Route::get("profile",[ProfileController::class,'index'])->name("profile");
Route::post("profile/profile-update",[ProfileController::class,'profileUpdate'])->name("profile.profile-update");
Route::post("profile/password-update",[ProfileController::class,'passwordUpdate'])->name("profile.password-update");

// Profile  ------------------------------------------


// Specialization  --------------------------------------
Route::put("specialization/{id}/change-status",[SpecializationController::class,'changeStatus'])->name("specialization.change-status");
Route::resource("specialization",SpecializationController::class);
// Specialization  --------------------------------------


// Doctor  --------------------------------------

// Get Specialization belongs to doctor 
Route::get("doctor/{id}/working-time",[DoctorController::class,"workingTime"])->name("doctor.working-time");
Route::get("doctor/{id}/get-specialization",[DoctorController::class,"getSpecialization"])->name("doctor.get-specialization");
Route::resource("doctor",DoctorController::class);
// Doctor  --------------------------------------



// Update Working Time Table 
Route::get("working-time/get-working-time",[WorkingTimeController::class,"getWorkingTime"])->name("working-time.get-working-time");
Route::put("working-time/update",[WorkingTimeController::class,"updateWorkingTime"])->name("working-time.update");



// Schedule -------------------------------------------
// Update schedule status 
Route::put("schedule/{id}/update-status",[ScheduleController::class,"updateStatus"])->name("schedule.update-status");
// Pending Schedule  
Route::get("schedule/pending-schedule",[ScheduleController::class,"pending"])->name("schedule.pending-schedule");

// Confirmed Schedule  
Route::get("schedule/confirmed-schedule",[ScheduleController::class,"confirmed"])->name("schedule.confirmed-schedule");

// completed Schedule  
Route::get("schedule/completed-schedule",[ScheduleController::class,"completed"])->name("schedule.completed-schedule");

// canceled Schedule  
Route::get("schedule/canceled-schedule",[ScheduleController::class,"canceled"])->name("schedule.canceled-schedule");

// Filter Date 
Route::get("schedule/filter-schedule",[ScheduleController::class,"filterSchedule"])->name("schedule.filter-schedule");

// Schedule ------------------------------------------- 

