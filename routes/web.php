<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingAppointmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,"index"]);

Route::get("{id}/news-detail",[PostController::class,"show"])->name('news-detail');
Route::get("/doctor-team",[HomeController::class,"doctorTeam"])->name('doctor-team');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // Profile  
    Route::put("profile/password-update",[FrontendProfileController::class,'passwordUpdate'])->name("profile.password-update");
    Route::put("profile/update",[FrontendProfileController::class,"profileUpdate"])->name("profile.update"); 
    Route::get("profile",[FrontendProfileController::class,"index"])->name("profile"); 

    // Booking Appoitment
    Route::get("{id}/booking-success",[BookingAppointmentController::class,"bookingSuccess"])->name("booking-success");
    Route::get("{id}/booking-appointment",[BookingAppointmentController::class,"bookAppointment"])->name("book-appointment");
    Route::post("create-appointment",[BookingAppointmentController::class,"createAppointment"])->name("create-appointment");
    // Booking Appoitment
    
    // Get Time Frame By Date 
    Route::POST("get-time-frame-by-date",[BookingAppointmentController::class,"getTimeFrameByDate"])->name("get-time-frame-by-date");
});

require __DIR__.'/auth.php';
