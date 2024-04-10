<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;

class ProfileController extends Controller
{ 
    use UploadTrait;
    public function index(){ 
        $user = auth()->user();
        return view("frontend.pages.profile",[
            'user' => $user,
        ]);
    } 

    public function profileUpdate(Request $request){
        $user = auth()->user();   
        $path = $this->updateImage($request,$user->avatar,"uploads","avatar");
        $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['email','required'], 
            'phone' => ['required'], 
            'address' => ['required'],
            'gender' => ['required'],
        ]);
        $user->update([
            "first_name" => $request->first_name, 
            "middle_name" => $request->middle_name, 
            "last_name" => $request->last_name, 
            "email" => $request->email, 
            "gender" => $request->gender, 
            "phone" => $request->phone, 
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
        auth()->user()->update([
            "password" => bcrypt($request->password),
        ]);
        return redirect()->back();
    }
}
