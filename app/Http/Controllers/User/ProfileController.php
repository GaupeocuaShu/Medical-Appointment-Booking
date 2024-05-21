<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ProfileController extends Controller
{ 
    use UploadTrait;
    public function index(){ 
        $user = auth()->user(); 
        $role = $user->role;
        if($role == 'admin') return redirect()->route("admin.profile");
        else if($role =='doctor') return redirect()->route('doctor.profile'); 
        return view("frontend.pages.profile",[
            'user' => $user,
        ]);
    } 

    public function profileUpdate(Request $request){
        $user = auth()->user();   
        $path = $this->updateImage($request,$user->avatar,"uploads","avatar");
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['email','required'], 
            'phone' => ['required'], 
            'date_of_birth' => ['required'],
        ],[
            'first_name.required' => "Tên không được trống", 
            'last_name.required' => "Tên họ không được trống", 
            'email.required' => "Email không được trống", 
            'email.email' => "Email không hợp lệ", 
            'phone.required' => "Số điện thoại không được trống",
            'date_of_birth.required' => "Ngày sinh không được trống", 
        ]);
        $user->update([
            "first_name" => $request->first_name, 
            "middle_name" => $request->middle_name, 
            "last_name" => $request->last_name, 
            "date_of_birth" => $request->date_of_birth, 
            "email" => $request->email, 
            "gender" => $request->gender, 
            "phone" => $request->phone, 
            "address" => $request->address,
            "avatar" => $path != null ? $path : $user->avatar,
        ]);
        Session::flash("status","Update Profile Successfully");
        return redirect()->back();
    }

    public function passwordUpdate(Request $request){
        $request->validate([
            "current_password" => ["required","current_password"], 
            "password" => ["required","confirmed"], 
        ]); 
        auth()->user()->update([
            "password" => bcrypt($request->password),
        ]);
        Session::flash("status","Update Password Successfully");
        return redirect()->back();
    }
}
