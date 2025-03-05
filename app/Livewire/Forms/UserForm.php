<?php

namespace App\Livewire\Forms;

use App\Models\Access;
use App\Models\Image;
use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;
    public $name, $email, $phone, $cin, $role = "Select Role", $status = "Select Status", $formation_id = 'Select Formation', $image;
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cin' => 'required',
            'role' => 'required',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        // dd('inside the store');
        // dd($this->status);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cin' => $this->cin,
            'phone' => $this->phone,
            'status' => $this->status,
        ]);
        // dd($user->id);
        if ($this->image) {
            // dd($this->image);
            Image::store($user, $this->image, 'users');
        }
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
