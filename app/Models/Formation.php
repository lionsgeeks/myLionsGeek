<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    //
    protected $fillable=[
        "class_name",
        "formation_name",
        "start_time",
        "end_time",
    ];
}
