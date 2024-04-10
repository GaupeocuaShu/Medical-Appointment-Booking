<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; 
    public $fillable =[
        "thumb_image","user_id","title","short_description","content","status"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
