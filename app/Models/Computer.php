<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $fillable = [
        "reference",
        "CpuGpu",
        "computer_state",
        "is_available",
        "user_id",
        "start_date",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
