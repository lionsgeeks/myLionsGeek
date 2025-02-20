<?php

<<<<<<< HEAD
<<<<<<< Updated upstream
use App\Http\Controllers\UserController;
use App\Models\User;
=======
use App\Http\Controllers\FormationContorller;
>>>>>>> Stashed changes
=======
use App\Http\Controllers\ComputerController;
use App\Livewire\Computer\CreateComputer;
use App\Livewire\Computer\EditComputer;
use App\Models\Computer;
>>>>>>> sara
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('create', 'create');   

Route::view('places', 'places');   
Route::get('/users', [UserController::class, 'index'])->middleware(['auth']);
Route::get('/addusers', [UserController::class, 'adduser'])->middleware(['auth']);
Route::get('/user/{user}', [UserController::class, 'show'])->middleware(['auth']);


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
<<<<<<< HEAD
Route::view("formation", "formation");
=======

Route::get('/create-computers', [CreateComputer::class, 'createComputer'])->name('computer.create');
Route::get('/updateComputer', [EditComputer::class, 'updateView']);
Route::get('/computer/update/{computer}', [ComputerController::class, 'computerUpdate']);

>>>>>>> sara
require __DIR__.'/auth.php';
