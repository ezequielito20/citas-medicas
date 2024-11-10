<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// rutas para el admin
Route::get('/', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('auth');

    // rutas para el admin - users
Route::get('/usuarios', [UserController::class, 'index'])
    ->name('admin.users.index')
    ->middleware('auth');
    



Auth::routes();

