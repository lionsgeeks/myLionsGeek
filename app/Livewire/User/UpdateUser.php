<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;

class UpdateUser extends Component
{
    public UserForm $userForm;
    public function mount(User $user)
    {
        $this->userForm->setUser($user);
    }
    public function save()
    {
        $this->userForm->update();
 
        $this->redirect('/users');
    }
    public function render()
    {
        return view('livewire.user.update-user');
    }
}
