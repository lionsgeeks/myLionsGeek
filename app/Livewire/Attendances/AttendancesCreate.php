<?php

namespace App\Livewire\Attendances;

use App\Models\Attendances;
use Livewire\Component;
use Livewire\Attributes\On;

class AttendancesCreate extends Component
{
    public $staff_name ;
    public $attendance_day;
    public $formation_id ;
    public $attendances;
    public function mount()
    {
        $url = url()->current();
        // Find the position of the last slash in the URL
        $lastSlashPos = strrpos($url, '/');
        // Extract the ID by getting the substring after the last slash
        $id = substr($url, $lastSlashPos + 1);
        $this->formation_id = $id;
        $this->loadEvent();
  
    }

    public function loadEvent(){
        $this->attendances = Attendances::select('staff_name', 'attendance_day')
        ->get()
        ->map(function ($attendance) {
            return [
                'title' => $attendance->staff_name,
                'start' => $attendance->attendance_day,
                
            ];
        })->toArray();
    }
    protected $listeners = ['addAttendances'];

    public function addAttendances($attendance_day)
    {
        $this->staff_name = auth()->user()->name;

        Attendances::create([
            'staff_name' => $this->staff_name,
            'attendance_day' => $attendance_day,
            'formation_id' => $this->formation_id, 
        ]);
        $this->loadEvent();
        $this->dispatch("eventloaded",events:$this->attendances);
        return back();
        // dd( 'Attendance added successfully!');
    }
    

   


    public function render()
    {
        return view('livewire.attendances.attendances-create');
    }
}
