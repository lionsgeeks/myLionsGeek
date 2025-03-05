<?php


use App\Http\Controllers\UserController;
use App\Models\User;

use App\Http\Controllers\FormationContorller;
use App\Http\Controllers\ComputerController;
use App\Livewire\Computer\CreateComputer;
use App\Livewire\Computer\EditComputer;
use App\Models\Computer;
use App\Http\Controllers\EquipmentController;
// use App\Http\Controllers\UserController;
// use App\Models\User;
// use App\Http\Controllers\FormationContorller;
use App\Http\Controllers\ReservationController;
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



Route::get('/equipment',[EquipmentController::class,'index'])->middleware(["auth"]);


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::view("formation", "formation");

Route::get('/create-computers', [CreateComputer::class, 'createComputer'])->name('computer.create');
Route::get('/updateComputer', [EditComputer::class, 'updateView']);
Route::get('/computer/update/{computer}', [ComputerController::class, 'computerUpdate']);

Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
Route::get('/add_password/{user}', [UserController::class, 'addPasswordView']);
Route::post('/add_password/{user}', [UserController::class, 'setPassword'])->name('user.add_password');


require __DIR__.'/auth.php';
