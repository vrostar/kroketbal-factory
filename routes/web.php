<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnackController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('snacks/create', [SnackController::class, 'create'])->name('snacks.create');
Route::post('snacks', [SnackController::class, 'store'])->name('snacks.store');
