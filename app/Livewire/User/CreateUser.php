<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Formation;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use WithFileUploads;
    
    public UserForm $userForm;
    public function save() {
        $this->userForm->store();
        // $this->redirect('/users');
        $this->dispatch('close');
    }
    public function render()
    {
        
        return view('livewire.user.create-user', [
            'formations' => Formation::all()
        ]);
    }
}
