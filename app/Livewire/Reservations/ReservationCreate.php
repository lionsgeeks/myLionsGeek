<?php

namespace App\Livewire\Reservations;

use App\Models\Places;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ReservationCreate extends Component
{
    //TODO!!! OPTIMIZE THE CODE
    //TODO!!! OPTIMIZE THE CODE
    //TODO!!! OPTIMIZE THE CODE

    #[Validate('required')]
    public $start;
    #[Validate('required')]
    public $end;

    public $showModal = false;

    public $date = '';
    public $placeID = '';
    public $events = [];

    public function mount()
    {
        $this->events = $this->reservations();
    }

    public function updatedDate()
    {
        $reservations = Reservation::where('date', $this->date)->get();
        $tempEv = $this->getEvents($reservations);

        $this->dispatch('listen', events: $tempEv);
    }

    public function updatedPlaceID()
    {
        if ($this->placeID) {
            $reservations = Reservation::whereHas('places', function ($query) {
                $query->where('places.id', $this->placeID);
            })->get();
        } else {
            $reservations = Reservation::getViewableReservations(1);
        }

        $tempEv = $this->getEvents($reservations);

        $this->dispatch('listen', events: $tempEv);
    }

    public function save($info, $placeID)
    {
        $place = Places::findOrFail($placeID);
        $user = Auth::user();
        $res = Reservation::create([
            'date' => substr($info['startStr'], 0, 10),
            'start' => $info['startStr'],
            'end' => $info['endStr'],
            'user_id' => $user->id,
        ]);

        $res->places()->attach($place->id);

        // to force reload the page
        return redirect(request()->header('Referer'));
    }

    public function updateEvent($event)
    {
        $ev = $event["event"];
        $res = Reservation::findOrFail($event["event"]["id"]);

        $res->update([
            'date' => substr($ev["start"], 0, 10),
            'start' => $ev['start'],
            'end' => $ev['end'],
        ]);
    }




    // TODO: always validate the user auth/perm
    public function deleteEvent($event)
    {
        $res = Reservation::findOrFail($event['event']['id']);
        $res->delete();
    }


    // TODO: check if i need to auth the user to show the reservations
    // TODO: filter reservations based on access too
    // TODO: if events has passed or denied/approved then it's display should be background
    // TODO: bgColor based on place or id
    #[Computed()]
    public function reservations()
    {
        // 1 for the user's reservations. 0 for all the reservations
        $reservations = Reservation::getViewableReservations(0);
        $events = [];

        foreach ($reservations as $res) {
            $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $events[] = [
                'id' => $res->id,
                'start' => $res->start,
                'end' => $res->end,
                'title' => $res->user->name,
                'backgroundColor' => $randomColor,
                'display' => $res->hasPassed() || $res->approvedOrCanceled() ? 'background' : 'block',
            ];
        }

        return $events;
    }

    #[Computed()]
    public function coworks()
    {
        return Places::where('place_type', 'co_work')->where('state', 1)->get();
    }


    protected function getEvents($reservations)
    {
        $events = [];
        foreach ($reservations as $res) {
            $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $events[] = [
                'id' => $res->id,
                'start' => $res->start,
                'end' => $res->end,
                'title' => $res->user->name,
                'backgroundColor' => $randomColor,
                'display' => $res->hasPassed() || $res->approvedOrCanceled() ? 'background' : 'block',
            ];
        }
        return $events;
    }
}
