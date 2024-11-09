<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// rutas para el admin
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('auth')
    ;



Auth::routes();

