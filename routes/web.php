<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnackController;
use App\Http\Controllers\UserController;
// Authentication Routes
Auth::routes();

// Home and Landing Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Profile Routes
Route::get('/users/profile', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/give-admin', [UserController::class, 'giveAdmin'])->name('users.give-admin');
    Route::post('/users/{user}/remove-admin', [UserController::class, 'removeAdmin'])->name('users.remove-admin');
});

// Snack Routes
Route::get('/snacks', [SnackController::class, 'index'])->name('snacks.index');
Route::get('/snacks/create', [SnackController::class, 'create'])->name('snacks.create')->middleware(['auth', 'createSnacks']);
Route::post('/snacks', [SnackController::class, 'store'])->name('snacks.store');
Route::get('/snacks/{snack}/edit', [SnackController::class, 'edit'])->name('snacks.edit')->middleware('auth');
Route::put('/snacks/{snack}', [SnackController::class, 'update'])->name('snacks.update')->middleware('auth');
Route::delete('/snacks/{snack}', [SnackController::class, 'destroy'])->name('snacks.destroy')->middleware('auth');
Route::get('/snacks/{snack}', [SnackController::class, 'show'])
    ->name('snacks.show')
    ->middleware('viewedSnacks');



