<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SecretaryController;

Auth::routes();
Route::get('/logout', [AdminController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// rutas para el admin ---------------------------------------------------------------
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

// rutas para el admin - secretaries----------------------------------------------------------
Route::get('/secretaries', [SecretaryController::class, 'index'])
    ->name('admin.secretaries.index')
    ->middleware('auth');

Route::get('/secretaries/create', [SecretaryController::class, 'create'])
    ->name('admin.secretaries.create')
    ->middleware('auth');

Route::post('/secretaries/create', [SecretaryController::class, 'store'])
    ->name('admin.secretaries.store')
    ->middleware('auth');

Route::get('/secretaries/{id}', [SecretaryController::class, 'show'])
    ->name('admin.secretaries.show')
    ->middleware('auth');

Route::get('/secretaries/{id}/edit', [SecretaryController::class, 'edit'])
    ->name('admin.secretaries.edit')
    ->middleware('auth');

Route::put('/secretaries/{id}', [SecretaryController::class, 'update'])
    ->name('admin.secretaries.update')
    ->middleware('auth');

Route::get('/secretaries/{id}/delete', [SecretaryController::class, 'destroy'])
    ->name('admin.secretaries.destroy')
    ->middleware('auth');

// rutas para el admin - patients----------------------------------------------------------
Route::get('/patients', [PatientController::class, 'index'])
    ->name('admin.patients.index')
    ->middleware('auth');

Route::get('/patients/create', [PatientController::class, 'create'])
    ->name('admin.patients.create')
    ->middleware('auth');

Route::post('/patients/create', [PatientController::class, 'store'])
    ->name('admin.patients.store')
    ->middleware('auth');

Route::get('/patients/{id}', [PatientController::class, 'show'])
    ->name('admin.patients.show')
    ->middleware('auth');

Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])
    ->name('admin.patients.edit')
    ->middleware('auth');

Route::put('/patients/{id}', [PatientController::class, 'update'])
    ->name('admin.patients.update')
    ->middleware('auth');

Route::get('/patients/{id}/delete', [PatientController::class, 'destroy'])
    ->name('admin.patients.destroy')
    ->middleware('auth');


// rutas para el admin - offices----------------------------------------------------------
Route::get('/offices', [OfficeController::class, 'index'])
    ->name('admin.offices.index')
    ->middleware('auth');

Route::get('/offices/create', [OfficeController::class, 'create'])
    ->name('admin.offices.create')
    ->middleware('auth');

Route::post('/offices/create', [OfficeController::class, 'store'])
    ->name('admin.offices.store')
    ->middleware('auth');

Route::get('/offices/{id}', [OfficeController::class, 'show'])
    ->name('admin.offices.show')
    ->middleware('auth');

Route::get('/offices/{id}/edit', [OfficeController::class, 'edit'])
    ->name('admin.offices.edit')
    ->middleware('auth');

Route::put('/offices/{id}', [OfficeController::class, 'update'])
    ->name('admin.offices.update')
    ->middleware('auth');

Route::get('/offices/{id}/delete', [OfficeController::class, 'destroy'])
    ->name('admin.offices.destroy')
    ->middleware('auth');

// rutas para el admin - doctors----------------------------------------------------------
Route::get('/doctors', [DoctorController::class, 'index'])
    ->name('admin.doctors.index')
    ->middleware('auth');

Route::get('/doctors/create', [DoctorController::class, 'create'])
    ->name('admin.doctors.create')
    ->middleware('auth');

Route::post('/doctors/create', [DoctorController::class, 'store'])
    ->name('admin.doctors.store')
    ->middleware('auth');

Route::get('/doctors/{id}', [DoctorController::class, 'show'])
    ->name('admin.doctors.show')
    ->middleware('auth');

Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])
    ->name('admin.doctors.edit')
    ->middleware('auth');

Route::put('/doctors/{id}', [DoctorController::class, 'update'])
    ->name('admin.doctors.update')
    ->middleware('auth');

Route::get('/doctors/{id}/delete', [DoctorController::class, 'destroy'])
    ->name('admin.doctors.destroy')
    ->middleware('auth');