<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
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

    public function topTenFavDoctor(Request $request){
        $month = $request->month; 
        $schedules = Schedule::select('doctor_id', DB::raw('COUNT(*) as appointment_count'))
            ->whereMonth('appointment', $month)
            ->groupBy('doctor_id')
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
}
