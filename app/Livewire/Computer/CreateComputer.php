<?php

namespace App\Livewire\Computer;

use App\Livewire\Forms\Computer\ComputerForm;
use App\Models\Computer;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CreateComputer extends Component
{
    // public $users;
    public $computers;
    public ComputerForm $form;
    public $showModal = false;

    public function add()
    {
        $this->form->save();
        $this->showModal = false;

        // return $this->redirect('/create-computers');
    }

    public function  createComputer()
    {
        return view('computer.computer');
    }

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }
    public function cancel()
    {
        $this->reset();
        $this->showModal = false;
    }


    #[Computed()]
    public function users()
    {
        return User::all();
    }

    public function render()
    {
        return view('livewire.computer.create-computer');
    }
}
