<?php

namespace App\Livewire\Forms;

use App\Models\Access;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;
    public $name, $email, $phone, $cin, $role = "Select Role", $status = "Select Status";
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cin' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);
        // dd($this->status);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cin' => $this->cin,
            'phone' => $this->phone,
            'status' => $this->status,
        ]);
        // dd($user->id);
        Access::create([
            'user_id' => $user->id,
            'role' => $this->role
        ]);
        $this->reset();
    }
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->cin = $user->cin;
        $this->phone = $user->phone;
        $this->status = $user->status;  
        $this->role = $user->access?->role;  
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cin' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);
        $this->user->update(
            [
                'name' => $this->name,
                'email' => $this->email,
                'cin' => $this->cin,
                'phone' => $this->phone,
                'status' => $this->status,
            ]
        );
        $access = Access::where('user_id', $this->user->id)->first();
        $access->update([
            'role' => $this->role
        ]);
    }
}
