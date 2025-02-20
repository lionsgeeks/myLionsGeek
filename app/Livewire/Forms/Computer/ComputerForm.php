<?php

namespace App\Livewire\Forms\Computer;

use App\Models\Computer;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ComputerForm extends Form
{

    public ?Computer $computer;

    #[Rule('required')]
    public $reference = '';

   

    #[Rule('required')]
    public $cpu = '';

    #[Rule('required')]
    public $gpu = '';

    #[Rule('required')]
    public $computer_state = '';

    #[Rule('required')]
    public $is_available = '';

    #[Rule('required')]
    public $user_id = '';


    #[Rule('required')]
    public $start_date = '';

    #[Rule('required')]
    public $device_name = '';

    public function setComputer(Computer $computer){
        $this->computer = $computer;
        $this->reference = $computer->reference;
        $this->cpu = $computer->cpu;
        $this->gpu = $computer->gpu;
        $this->computer_state = $computer->computer_state;
        $this->is_available = $computer->is_available;
        $this->user_id = $computer->user_id;
        $this->start_date = $computer->start_date;
        $this->device_name = $computer->device_name;
    }

    public function update() {
        $this->computer->update($this->all());
    }

    public function save() {
        $this->validate();
        Computer::create($this->all());
        $this->reset();
    }
      

}
