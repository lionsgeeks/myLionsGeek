<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    //
    protected $fillable=[
        "formation_id",
        "attendance_day",
        "staff_name",
    ];
    public function formation(){
       return $this->belongsTo(Formation::class);
    }
}
