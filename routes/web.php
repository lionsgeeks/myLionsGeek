<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\PlacesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
    Route::get('equipment', [EquipmentController::class, 'index'])->name('equipment.index');
    Route::post('equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');
    Route::post('equipment/update/{equipment}', [EquipmentController::class, 'update'])->name('equipment.update');
    Route::delete('equipment/destroy/{equipment}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
});
Route::get('/places', [PlacesController::class, 'index']);
Route::post('/places', [PlacesController::class, 'store'])->name('places.store');
Route::get('/places/{place}/edit', [PlacesController::class, 'edit'])->name('places.edit');
Route::post('/places/{place}', [PlacesController::class, 'update'])->name('places.update');
Route::delete('/places/{place}', [PlacesController::class, 'destroy'])->name('places.destroy');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
