<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\User\MyAppointmentController;
use App\Http\Controllers\User\BookingAppointmentController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient; 
use Illuminate\Support\Carbon;
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
Route::get("{id}/specialization-book",[HomeController::class,"specialzationBook"])->name('specialization-book');
Route::get("/specialization-list",[HomeController::class,"specialzationList"])->name('specialization-list');
Route::get("{id}/news-detail",[PostController::class,"show"])->name('news-detail');
Route::get("/doctor-team",[HomeController::class,"doctorTeam"])->name('doctor-team');
Route::get("/news",[HomeController::class,"newsList"])->name('news');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Login with society ---------------------------------------
//  By Google 
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name("google.redirect");
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();
    $user = User::firstOrCreate([
        'email' => $user->email, 
    ],[
        'password' => bcrypt(Str::random(24))
    ]);
    $patient = Patient::create([
        "user_id" => $user->id,
    ]);
    $patient->update(["patient_id" => $user->id.$user->phone.$patient->id.Carbon::create()->isoFormat("YYYYMMDDDD")]);
    Auth::login($user,true);
    return redirect('/');
});

// Login with society ---------------------------------------

Route::middleware('auth')->group(function () {

    // My Appointment  
    Route::put('cancel-appointment',[MyAppointmentController::class,'cancelAppointment'])->name('cancel-appontment');
    Route::get('my-appointment',[MyAppointmentController::class,"index"])->name("my-appointment");
    // Profile  
    Route::put("profile/password-update",[ProfileController::class,'passwordUpdate'])->name("profile.password-update");
    Route::put("profile/update",[ProfileController::class,"profileUpdate"])->name("profile.update"); 
    Route::get("profile",[ProfileController::class,"index"])->name("profile"); 

    // Booking Appoitment
    Route::get("{id}/booking-success",[BookingAppointmentController::class,"bookingSuccess"])->name("booking-success");
    Route::get("{id}/booking-appointment",[BookingAppointmentController::class,"bookAppointment"])->name("book-appointment");
    Route::post("create-appointment",[BookingAppointmentController::class,"createAppointment"])->name("create-appointment");
    // Booking Appoitment
    
    // Get Time Frame By Date 
    Route::POST("get-time-frame-by-date",[BookingAppointmentController::class,"getTimeFrameByDate"])->name("get-time-frame-by-date");
});

require __DIR__.'/auth.php';
