<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;

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
        ]);
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
        return redirect()->back();
    }
}
