<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class SetPassword extends Component
{
    public ?User $user;
    public $password, $password_confirmation;
    public function store()
    {
        if ($this->user && !$this->user->password) {
            $this->validate([
                'password' => ['required', 'string', 'confirmed', Password::defaults()]
            ]);
            // dd($this->user);
            $this->user->update([
                'password' => Hash::make($this->password)
            ]);
        }
        return redirect('register');
    }
    public function render()
    {
        return view('livewire.user.set-password');
    }
}
