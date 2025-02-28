<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasUuids;
    protected $fillable=[
        "class_name",
        "formation_name",
        "start_time",
        "end_time",
    ];
}
