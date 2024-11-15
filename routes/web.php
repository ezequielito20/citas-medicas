<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// rutas para el admin
Route::get('/', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('auth');

// rutas para el admin - users
Route::get('/users', [UserController::class, 'index'])
    ->name('admin.users.index')
    ->middleware('auth');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('admin.users.create')
    ->middleware('auth');

Route::post('/users/create', [UserController::class, 'store'])
    ->name('admin.users.store')
    ->middleware('auth');

Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('admin.users.show')
    ->middleware('auth');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])
    ->name('admin.users.edit')
    ->middleware('auth');

Route::put('/users/{id}', [UserController::class, 'update'])
    ->name('admin.users.update')
    ->middleware('auth');

Route::get('/users/{id}/delete', [UserController::class, 'destroy'])
    ->name('admin.users.destroy')
    ->middleware('auth');

Route::get('/logout', [AdminController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Auth::routes();
