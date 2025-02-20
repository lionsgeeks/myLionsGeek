<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use Livewire\Component;

class CreateUser extends Component
{
    public UserForm $userForm;
    public function save() {
        $this->userForm->store();
        $this->redirect('/users');
    }
    public function render()
    {
        return view('livewire.user.create-user');
    }
}
