<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    use UploadTrait;
    public function index(){
        $user  = Auth::user(); 
        $firstName = $user->first_name; 
        $middleName = $user->middle_name; 
        $lastName = $user->last_name; 

        return view("admin.profile.index",[ 
            "fullName" => $lastName." ".$middleName." ".$firstName,
            "user" => $user, 
            "firstName" => $firstName, 
            "middleName" => $middleName, 
            "lastName" => $lastName,
        ]);
    }
    public function profileUpdate(Request $request){
        
        $user = Auth::user();   
        $path = $this->updateImage($request,$user->avatar,"uploads","avatar");
        $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['email','required'], 
            'phone' => ['required'], 
            'address' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
        ]);
        $user->update([
            "first_name" => $request->first_name, 
            "middle_name" => $request->middle_name, 
            "last_name" => $request->last_name, 
            "email" => $request->email, 
            "gender" => $request->gender, 
            "phone" => $request->phone, 
            "description" => $request->description,
            "address" => $request->address,
            "avatar" => $path != null ? $path : $user->avatar,
            "date_of_birth" => $request->date_of_birth,

        ]);
        Session::flash("status","Update Profile Successfully");

        return redirect()->back();
    }
    public function passwordUpdate(Request $request){
        $request->validate([
            "current_password" => ["required","current_password"], 
            "password" => ["required","confirmed"], 
        ]); 
        Auth::user()->update([
            "password" => bcrypt($request->password),
        ]);
        Session::flash("status","Update Password Successfully");

        return redirect()->back();
    }
}
