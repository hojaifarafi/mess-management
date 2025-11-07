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
    Route::get('/meals/create', [App\Http\Controllers\Meal::class, 'create_meal'])->name('meal.create');
    Route::post('/meals', [App\Http\Controllers\Meal::class, 'store_meal'])->name('meals.store');
});

Route::middleware('auth')->group(function () {
    Route::middleware( App\Http\Middleware\Manager::class)->group(function () {
        Route::get('/meals/{id}/manage', [App\Http\Controllers\Meal::class, 'manage_meal'])->name('meal.manage');
        Route::get('/meals/{id}/edit', [App\Http\Controllers\Meal::class, 'edit_meal'])->name('meal.edit');
        Route::put('/meals/{id}', [App\Http\Controllers\Meal::class, 'update_meal'])->name('meal.update');
        Route::delete('/meals/{id}', [App\Http\Controllers\Meal::class, 'destroy_meal'])->name('meal.destroy');
        Route::get('/meals/{id}/settings', [App\Http\Controllers\Meal::class, 'meal_settings'])->name('meal.settings');
        Route::get('/meals/{id}/members', [App\Http\Controllers\Meal::class, 'meal_members'])->name('meal.members');
        Route::get('/meal/{id}/is-duplicate/{shortName}', [App\Http\Controllers\Meal::class, 'is_duplicate'])->name('meal.is-duplicate');
        Route::post('/meals/{id}/members', [App\Http\Controllers\Meal::class, 'store_member'])->name('meal.member.store');
        Route::delete('/meal/{id}/members/{memberId}', [App\Http\Controllers\Meal::class, 'remove_member'])->name('meal.member.remove');
        Route::get('/meal/{id}/users/search', [App\Http\Controllers\Meal::class, 'search_users'])->name('meal.search-users');
        Route::put('/meal/{id}/members/{memberId}', [App\Http\Controllers\Meal::class, 'update_member']);
        Route::put('/meal/{id}/members-order', [App\Http\Controllers\Meal::class, 'update_member_order']);
    });
});