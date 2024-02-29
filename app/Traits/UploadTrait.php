<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
trait UploadTrait{
    public function uploadImage(Request $request,$pathName,$inputName)
    {
        if($request->hasFile($inputName)){ 
            $image = $request->$inputName;
            $imageName = date('Y-m-d')."_".$image->getClientOriginalName();
            $path = $pathName."/".$imageName;
            $image->move(public_path($pathName),$imageName);
            return $path;
        }
    }

    public function updateImage(Request $request,$oldAvatar,$pathName,$inputName){ 
        if($request->hasFile($inputName)){ 
            if(File::exists(public_path($oldAvatar))) File::delete(public_path($oldAvatar)); 
            $image = $request->$inputName;
            $imageName = date('Y-m-d')."_".$image->getClientOriginalName();
            $path = $pathName."/".$imageName;
            $image->move(public_path($pathName),$imageName);
            return $path;
        }
    }
}