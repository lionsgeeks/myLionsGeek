<?php

use App\Http\Controllers\UserController;
use App\Models\User;
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

require __DIR__.'/auth.php';
