<?php

namespace App\Livewire\Forms;

use App\Mail\UserPassword;
use App\Models\Access;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;
    public $name, $email, $phone, $cin, $role = "Select Role", $status = "Select Status", $formation_id = null, $image;
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'cin' => 'required',
            'role' => 'required',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048',
            'formation_id' => "nullable",
        ]);
        $formationId = !empty($this->formation_id) ? $this->formation_id : null;
        // dd('inside the store');
        // dd($this->status);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cin' => $this->cin,
            'phone' => $this->phone,
            'status' => $this->status,
            'formation_id' => $formationId,
        ]);
        $baseUrl = url()->to('/');
        $link = $baseUrl . '/add_password/' . $user->id;
        Mail::to($user->email)->send(new UserPassword($link, $user->name));        // dd($user->id);
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
