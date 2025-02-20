<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $fillable = [
        "reference",
        "cpu",
        "gpu",
        "computer_state",
        "is_available",
        "user_id",
        "start_date",
        "device_name",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
