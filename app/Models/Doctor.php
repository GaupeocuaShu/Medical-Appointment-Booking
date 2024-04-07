<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "academic_degree", 
        "experience_year",
        "user_id",
        "workplace_id",
        "title",
        "note",
        "introduction",
        "training_process",
        "experience_list",
        "prize_and_research",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function specializations(){
        return $this->belongsToMany(Specialization::class);
    }
    public function working_times(){
        return $this->hasMany(WorkingTime::class);
    }

    public function workplace(){
        return $this->belongsTo(Workplace::class);
    }
}
