<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $fillable = [
        "user_id","patient_id","doctor_id","appointment","note","status"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
