<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationPlace extends Model
{
    protected $fillable = [
        'reservations_id',
        'places_id',
        'title',
        'description'
    ];
}
