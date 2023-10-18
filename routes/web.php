<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnackController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Routes
Route::get('/users/profile', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->group(function() {

});

Route::get('/snacks', [SnackController::class, 'index'])->name('snacks.index');
Route::get('/snacks/create', [SnackController::class, 'create'])->name('snacks.create')->middleware('auth');
Route::post('/snacks', [SnackController::class, 'store'])->name('snacks.store');
Route::get('/snacks/{snack}', [SnackController::class, 'show'])->name('snacks.show');
Route::get('/snacks/{snack}/edit', [SnackController::class, 'edit'])->name('snacks.edit')->middleware('auth');
Route::put('/snacks/{snack}', [SnackController::class, 'update'])->name('snacks.update');
Route::delete('/snacks/{snack}', [SnackController::class, 'destroy'])->name('snacks.destroy');

