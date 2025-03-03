<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reservation extends Model
{


    protected $fillable = [
        'date',
        'start',
        'end',
        'canceled',
        'passed',
        'approved',
        'user_id',
        'start_signed',
        'end_signed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function places()
    {
        return $this->belongsToMany(Places::class, 'reservation_places');
    }

    public function hasPassed()
    {
        return Carbon::parse($this->start)->isPast();
    }

    public function approvedOrCanceled()
    {
        return $this->approved || $this->canceled;
    }

    public static function getViewableReservations($owner)
    {
        $user = Auth::user();

        // get user permissions
        $cowAccess = $user->access->access_cowork;
        $studAccess = $user->access->access_studio;

        // get all the reservations
        if ($owner) {
            $reservations = self::where('user_id', $user->id);
        } else {
            $reservations = self::query() ;
        }


        if ($cowAccess) {
            $reservations = $reservations->whereHas('places', function ($query) {
                $query->where('place_type', 'co_work');
            });
        }

        if ($studAccess) {
            $reservations = $reservations->orWhereHas('places', function ($query) {
                $query->where('place_type', 'studio');
            });
        }

        return $reservations->get();
    }
}
