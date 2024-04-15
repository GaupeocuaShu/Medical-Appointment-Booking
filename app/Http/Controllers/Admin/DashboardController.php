<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class DashboardController extends Controller
{   
    public $currentYear;

    public function __construct()
    {
        $this->currentYear = Carbon::now()->year;
    }
    public function index(){ 
        $totalAdmin = count(User::where('role','admin')->get()); 
        $totalUser = count(User::where('role','user')->get()); 
        $totalDoctor = count(User::where('role','doctor')->get()); 
        $totalNews = count(Post::get());  
        return view("admin.dashboard.index",[
            'totalAdmin' => $totalAdmin, 
            'totalNews' =>  $totalNews,
            'totalDoctor' => $totalDoctor,
            'totalUser' => $totalUser
        ]);
    }
    // Top 10 Favorite Doctor Statistic     

    public function topTenFavDoctor(Request $request){
        $month = $request->month;  
        $schedules = Schedule::select('status','doctor_id', DB::raw('COUNT(*) as appointment_count'))
            ->whereMonth('appointment', $month) 
            ->whereYear('appointment',$this->currentYear)
            ->where('status','completed')
            ->groupBy('doctor_id','status')
            ->take(10)
            ->orderBy('appointment_count','desc')
            ->get() ;
        
        $labels = array(); 
        $datas = array(); 
        foreach($schedules as $s){ 
            $user = Doctor::findOrFail($s->doctor_id)->user;
            $labels[]= "Doctor " .getFullName($user);
            $datas[]= $s->appointment_count;
        } 

        return response([
            'labels' => $labels, 
            'datas' => $datas,
        ]);
    }
    // Get Booking Number By Month 

    public function bookingNumberByMonth(Request $request){
        $month = $request->month; 
        $daysInMonth = Carbon::create($month)->daysInMonth;
        $appointmentByDays = array();
        for($i=1 ; $i<=$daysInMonth;$i++){
            $appointmentByDays[$i]=Schedule::whereMonth("appointment",$month)
                                ->whereYear('appointment',$this->currentYear)
                                ->whereDay('appointment',$i)
                                ->where('status','completed')
                                ->count();
        }
        $labels = array_keys($appointmentByDays);
        $datas = array_values($appointmentByDays);
        return response([
            'labels' => $labels, 
            'datas' => $datas,
        ]);
    }

    // Get Booking Status 

    public function bookingStatusByMonth(Request $request){
        $month = $request->month; 
        $appointments = Schedule::select('status',DB::raw('COUNT(*) as count_appointment')) 
                ->whereMonth("appointment",$month)
                ->whereYear('appointment',$this->currentYear)
                ->groupBy('status') 
                ->get();
                             
        $labels = array(); 
        $datas = array();    
        foreach($appointments as $key => $app){
            $labels[] = $app->status; 
            $datas[] = $app->count_appointment;
        };
        return response([
            'labels' => $labels, 
            'datas' => $datas,
        ]);
    }
}
