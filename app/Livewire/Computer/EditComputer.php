<?php

namespace App\Livewire\Computer;

use App\Livewire\Forms\Computer\ComputerForm;
use App\Models\Computer;
use App\Models\User;
use Livewire\Component;

class EditComputer extends Component
{
    public ComputerForm $form;

    public function mount(Computer $computer)
    {
        $this->form->setComputer($computer);
    }

    public function editComputer()
    {
        $this->form->update();
        return redirect('/create-computers');
    }
    public function render()
    {
        return view('livewire.computer.edit-computer', [
            "users" => User::all(),
        ]);
    }
}
