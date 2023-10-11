<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnackController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/snacks', [SnackController::class, 'index'])->name('snacks.index');
Route::get('/snacks/create', [SnackController::class, 'create'])->name('snacks.create');
Route::post('/snacks', [SnackController::class, 'store'])->name('snacks.store');
Route::get('/snacks/{snack}', [SnackController::class, 'show'])->name('snacks.show');
Route::get('/snacks/{snack}/edit', [SnackController::class, 'edit'])->name('snacks.edit');
Route::put('/snacks/{snack}', [SnackController::class, 'update'])->name('snacks.update');
Route::delete('/snacks/{snack}', [SnackController::class, 'destroy'])->name('snacks.destroy');

