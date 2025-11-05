<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\Dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Meal Routes
Route::middleware('auth')->group(function () {
    Route::get('/meals/create', [App\Http\Controllers\Meal::class, 'create_meal'])->name('meals.create');
    Route::post('/meals', [App\Http\Controllers\Meal::class, 'store_meal'])->name('meals.store');
});

Route::middleware('auth')->group(function () {
    Route::middleware( App\Http\Middleware\Manager::class)->group(function () {
        Route::get('/meals/{id}/manage', [App\Http\Controllers\Meal::class, 'manage_meal'])->name('meals.manage');
        Route::get('/meals/{id}/edit', [App\Http\Controllers\Meal::class, 'edit_meal'])->name('meals.edit');
        Route::put('/meals/{id}', [App\Http\Controllers\Meal::class, 'update_meal'])->name('meals.update');
        Route::delete('/meals/{id}', [App\Http\Controllers\Meal::class, 'destroy_meal'])->name('meals.destroy');
    });
});