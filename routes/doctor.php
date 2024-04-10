<?php

use App\Http\Controllers\Doctor\PostController;
use App\Http\Controllers\Doctor\ProfileController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\Doctor\WorkingtimeController;
use Illuminate\Support\Facades\Route;
// Profile  ------------------------------------------
Route::get("profile",[ProfileController::class,'index'])->name("profile");
Route::post("profile/profile-update",[ProfileController::class,'profileUpdate'])->name("profile.profile-update");
Route::post("profile/password-update",[ProfileController::class,'passwordUpdate'])->name("profile.password-update");

Route::put("profile/doctor-profile-update",[ProfileController::class,'doctorProfileUpdate'])->name("profile.doctor-profile-update");

Route::get("get-specialization",[ProfileController::class,"getSpecialization"])->name("get-specialization");

// Working Time ------------------------------------
// Update Working Time Table  
Route::get("working-time/index",[WorkingtimeController::class,"index"])->name("working-time.index");
Route::get("working-time/get-working-time-for-edit",[WorkingtimeController::class,"getWorkingTimeForEdit"])->name("working-time.get-working-time-for-edit");
Route::get("working-time/get-working-time",[WorkingtimeController::class,"getWorkingTime"])->name("working-time.get-working-time");
Route::get("working-time/edit",[WorkingtimeController::class,"edit"])->name("working-time.edit");
Route::put("working-time/update",[WorkingTimeController::class,"updateWorkingTime"])->name("working-time.update");
// Working Time ------------------------------------



// Doctor Schedule  --------------------------------------
Route::get("schedule/{id}/show",[ScheduleController::class,"show"])->name("schedule.show");
Route::get("schedule/index",[ScheduleController::class,"index"])->name("schedule.index");
// Doctor Schedule  --------------------------------------

// Post --------------------------------------

Route::post('/upload',[PostController::class,"upload"])->name('ckeditor.upload');
Route::resource("post",PostController::class);
// Post --------------------------------------
