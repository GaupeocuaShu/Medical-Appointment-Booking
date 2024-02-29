<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SpecializationController;
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
Route::resource("specialization",SpecializationController::class);
// Specialization  --------------------------------------
