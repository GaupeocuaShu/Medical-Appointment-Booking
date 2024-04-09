<?php
use App\Http\Controllers\Doctor\ProfileController;
use Illuminate\Support\Facades\Route;
// Profile  ------------------------------------------
Route::get("profile",[ProfileController::class,'index'])->name("profile");
Route::post("profile/profile-update",[ProfileController::class,'profileUpdate'])->name("profile.profile-update");
Route::post("profile/password-update",[ProfileController::class,'passwordUpdate'])->name("profile.password-update");

Route::put("profile/doctor-profile-update",[ProfileController::class,'doctorProfileUpdate'])->name("profile.doctor-profile-update");

Route::get("get-specialization",[ProfileController::class,"getSpecialization"])->name("get-specialization");

// Working Time ------------------------------------
// Update Working Time Table 
Route::get("working-time/get-working-time",[ProfileController::class,"getWorkingTime"])->name("working-time.get-working-time");
// Route::put("working-time/update",[WorkingTimeController::class,"updateWorkingTime"])->name("working-time.update");
// Working Time ------------------------------------
