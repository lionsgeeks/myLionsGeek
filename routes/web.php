<?php

use App\Http\Controllers\ComputerController;
use App\Livewire\Computer\CreateComputer;
use App\Livewire\Computer\EditComputer;
use App\Models\Computer;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/create-computers', [CreateComputer::class, 'createComputer'])->name('computer.create');
Route::get('/updateComputer', [EditComputer::class, 'updateView']);
Route::get('/computer/update/{computer}', [ComputerController::class, 'computerUpdate']);

require __DIR__.'/auth.php';
