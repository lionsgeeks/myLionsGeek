<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function adduser()
    {
        return view('users.adduser');
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function addPasswordView(User $user)
    {
        return view('users.add_password', compact('user'));
    }
    public function setPassword(Request $request, User $user) {
        dd($request);
    }
}
