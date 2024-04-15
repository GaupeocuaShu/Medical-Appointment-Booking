<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\DoctorScheduleController;
use App\Http\Controllers\Admin\PostManagementController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\admin\WorkingTimeController;
use App\Http\Controllers\Admin\WorkplaceController;
use App\Http\Controllers\Doctor\PostController;
use App\Models\Workplace;
use Illuminate\Support\Facades\Route;

// Dashboard  ------------------------------------ 

// Top 10 Favorite Doctor Statistic 
Route::get("dashboard/top-ten-fav-doctor",[DashboardController::class,"topTenFavDoctor"])->name("dashboard.top-ten-fav-doctor");
// Get Booking Number By Month 
Route::get("dashboard/booking-number-by-month",[DashboardController::class,"bookingNumberByMonth"])->name("dashboard.booking-number-by-month");
// Get Booking Status 
Route::get("dashboard/booking-status-by-month",[DashboardController::class,"bookingStatusByMonth"])->name("dashboard.booking-status-by-month");

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

// Get Working Time 
Route::get("doctor/get-working-time",[DoctorController::class,"getWorkingTime"])->name("doctor.get-working-time");
// Edit and add Working Time for Doctor  
Route::get("doctor/{id}/working-time",[DoctorController::class,"workingTime"])->name("doctor.working-time");
// Get Specialization belongs to doctor 
Route::get("doctor/{id}/get-specialization",[DoctorController::class,"getSpecialization"])->name("doctor.get-specialization");
Route::resource("doctor",DoctorController::class);

// Doctor  --------------------------------------


// Doctor Schedule  --------------------------------------
Route::get("doctor/schedule/{id}/index",[DoctorScheduleController::class,"index"])->name("doctor.schedule.index");
// Doctor Schedule  --------------------------------------


// Working Time ------------------------------------
// Update Working Time Table 
Route::get("working-time/get-working-time",[WorkingTimeController::class,"getWorkingTime"])->name("working-time.get-working-time");
Route::put("working-time/update",[WorkingTimeController::class,"updateWorkingTime"])->name("working-time.update");
// Working Time ------------------------------------

// Workplace------------------------------------
Route::put("workplace/{id}/change-status",[WorkplaceController::class,'changeStatus'])->name("workplace.change-status");
Route::resource("workplace",WorkplaceController::class);
// Workplace------------------------------------


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

Route::get("schedule/{id}/show",[ScheduleController::class,"show"])->name("schedule.show");
// Schedule ------------------------------------------- 




// User ------------------------------------------- 
Route::put("user/{id}/update-role",[UserController::class,"updateRole"])->name("user.update-role");
Route::resource("user",UserController::class);
// User ------------------------------------------- 

// Post ------------------------------------------- 
Route::put("post/{id}/change-status",[PostManagementController::class,"changeStatus"])->name('post.change-status');
Route::resource("post",PostManagementController::class);
// Post ------------------------------------------- 


