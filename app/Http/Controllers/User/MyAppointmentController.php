<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelBooking;
class MyAppointmentController extends Controller
{
    public function index(){
        $userID = auth()->user()->id;
        $mySchedules = Schedule::with('user')->with('doctor')->where('user_id',$userID)->orderBy('appointment','desc')->get(); 
        return view("frontend.pages.my-appointment",[
            'mySchedules' => $mySchedules,

        ]);
    }

    public function cancelAppointment(Request $request){ 
        $id = $request->id;
        $schedule = Schedule::findOrFail($id); 
        $schedule->update(['status' => 'canceled']);
        Mail::send(new CancelBooking( $schedule));

        return response(['status' => 'success', 'message'=>'Đã Hủy Lịch Hẹn' ]);
    }

}
