<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\ConfigurationController;

Auth::routes();
Route::get('/logout', [AdminController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// rutas principales -----------------------------------------------------------------
Route::get('/', [WebController::class, 'index'])
    ->name('admin.home');
// rutas para el usuario -------------------------------------------------------------
//ajax
Route::get('/office/{id}', [WebController::class, 'offices_data'])->name('offices_data')->middleware('auth','can:offices_data');
Route::get('/doctors_reservations/{id}', [WebController::class, 'doctors_reservations'])->name('doctors_reservations')->middleware('auth','can:doctors_reservations');
Route::get('/see_reservations/{id}', [AdminController::class, 'see_reservations'])->name('admin.see_reservations')->middleware('auth','can:admin.see_reservations');
Route::post('/event/create', [EventController::class, 'store'])->name('admin.events.store')->middleware('auth','can:admin.events.store');
Route::get('/events/{id}/delete', [EventController::class, 'destroy'])
    ->name('admin.events.destroy')->middleware('auth','can:admin.events.destroy');

// rutas para el admin ---------------------------------------------------------------
Route::get('/index', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('auth');

// rutas para el admin - users
Route::get('/users', [UserController::class, 'index'])
    ->name('admin.users.index')
    ->middleware('auth','can:admin.users.index');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('admin.users.create')
    ->middleware('auth','can:admin.users.create');

Route::post('/users/create', [UserController::class, 'store'])
    ->name('admin.users.store')
    ->middleware('auth','can:admin.users.store');

Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('admin.users.show')
    ->middleware('auth','can:admin.users.show');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])
    ->name('admin.users.edit')
    ->middleware('auth','can:admin.users.edit');

Route::put('/users/{id}', [UserController::class, 'update'])
    ->name('admin.users.update')
    ->middleware('auth','can:admin.users.update');

Route::get('/users/{id}/delete', [UserController::class, 'destroy'])
    ->name('admin.users.destroy')
    ->middleware('auth','can:admin.users.destroy');

// rutas para el admin - secretaries----------------------------------------------------------
Route::get('/secretaries', [SecretaryController::class, 'index'])
    ->name('admin.secretaries.index')
    ->middleware('auth','can:admin.secretaries.index');

Route::get('/secretaries/create', [SecretaryController::class, 'create'])
    ->name('admin.secretaries.create')
    ->middleware('auth','can:admin.secretaries.create');

Route::post('/secretaries/create', [SecretaryController::class, 'store'])
    ->name('admin.secretaries.store')
    ->middleware('auth','can:admin.secretaries.store');

Route::get('/secretaries/{id}', [SecretaryController::class, 'show'])
    ->name('admin.secretaries.show')
    ->middleware('auth','can:admin.secretaries.show');

Route::get('/secretaries/{id}/edit', [SecretaryController::class, 'edit'])
    ->name('admin.secretaries.edit')
    ->middleware('auth','can:admin.secretaries.edit');

Route::put('/secretaries/{id}', [SecretaryController::class, 'update'])
    ->name('admin.secretaries.update')
    ->middleware('auth','can:admin.secretaries.update');

Route::get('/secretaries/{id}/delete', [SecretaryController::class, 'destroy'])
    ->name('admin.secretaries.destroy')
    ->middleware('auth','can:admin.secretaries.destroy');

// rutas para el admin - patients----------------------------------------------------------
Route::get('/patients', [PatientController::class, 'index'])
    ->name('admin.patients.index')
    ->middleware('auth','can:admin.patients.index');

Route::get('/patients/create', [PatientController::class, 'create'])
    ->name('admin.patients.create')
    ->middleware('auth','can:admin.patients.create');

Route::post('/patients/create', [PatientController::class, 'store'])
    ->name('admin.patients.store')
    ->middleware('auth','can:admin.patients.store');

Route::get('/patients/{id}', [PatientController::class, 'show'])
    ->name('admin.patients.show')
    ->middleware('auth','can:admin.patients.show');

Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])
    ->name('admin.patients.edit')
    ->middleware('auth','can:admin.patients.edit');

Route::put('/patients/{id}', [PatientController::class, 'update'])
    ->name('admin.patients.update')
    ->middleware('auth','can:admin.patients.update');

Route::get('/patients/{id}/delete', [PatientController::class, 'destroy'])
    ->name('admin.patients.destroy')
    ->middleware('auth','can:admin.patients.destroy');


// rutas para el admin - offices----------------------------------------------------------
Route::get('/offices', [OfficeController::class, 'index'])
    ->name('admin.offices.index')
    ->middleware('auth','can:admin.offices.index');

Route::get('/offices/create', [OfficeController::class, 'create'])
    ->name('admin.offices.create')
    ->middleware('auth','can:admin.offices.create');

Route::post('/offices/create', [OfficeController::class, 'store'])
    ->name('admin.offices.store')
    ->middleware('auth','can:admin.offices.store');

Route::get('/offices/{id}', [OfficeController::class, 'show'])
    ->name('admin.offices.show')
    ->middleware('auth','can:admin.offices.show');

Route::get('/offices/{id}/edit', [OfficeController::class, 'edit'])
    ->name('admin.offices.edit')
    ->middleware('auth','can:admin.offices.edit');

Route::put('/offices/{id}', [OfficeController::class, 'update'])
    ->name('admin.offices.update')
    ->middleware('auth','can:admin.offices.update');

Route::get('/offices/{id}/delete', [OfficeController::class, 'destroy'])
    ->name('admin.offices.destroy')
    ->middleware('auth','can:admin.offices.destroy');

// rutas para el admin - doctors----------------------------------------------------------
Route::get('/doctors', [DoctorController::class, 'index'])
    ->name('admin.doctors.index')
    ->middleware('auth','can:admin.doctors.index');

Route::get('/doctors/create', [DoctorController::class, 'create'])
    ->name('admin.doctors.create')
    ->middleware('auth','can:admin.doctors.create');

Route::post('/doctors/create', [DoctorController::class, 'store'])
    ->name('admin.doctors.store')
    ->middleware('auth','can:admin.doctors.store');

    //Reportes -----------------------
Route::get('/doctors/pdf', [DoctorController::class, 'pdf'])
->name('admin.doctors.pdf')
->middleware('auth','can:admin.doctors.pdf');

Route::get('/doctors/reports', [DoctorController::class, 'reports'])
->name('admin.doctors.reports')
->middleware('auth','can:admin.doctors.reports');

    // --------------------------------------

Route::get('/doctors/{id}', [DoctorController::class, 'show'])
    ->name('admin.doctors.show')
    ->middleware('auth','can:admin.doctors.show');

Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])
    ->name('admin.doctors.edit')
    ->middleware('auth','can:admin.doctors.edit');

Route::put('/doctors/{id}', [DoctorController::class, 'update'])
    ->name('admin.doctors.update')
    ->middleware('auth','can:admin.doctors.update');

Route::get('/doctors/{id}/delete', [DoctorController::class, 'destroy'])
    ->name('admin.doctors.destroy')
    ->middleware('auth','can:admin.doctors.destroy');

    

// rutas para el admin - hours----------------------------------------------------------
Route::get('/hours', [HourController::class, 'index'])
    ->name('admin.hours.index')
    ->middleware('auth','can:admin.hours.index');

Route::get('/hours/create', [HourController::class, 'create'])
    ->name('admin.hours.create')
    ->middleware('auth','can:admin.hours.create');

Route::post('/hours/create', [HourController::class, 'store'])
    ->name('admin.hours.store')
    ->middleware('auth','can:admin.hours.store');

Route::get('/hours/{id}', [HourController::class, 'show'])
    ->name('admin.hours.show')
    ->middleware('auth','can:admin.hours.show');

Route::get('/hours/{id}/edit', [HourController::class, 'edit'])
    ->name('admin.hours.edit')
    ->middleware('auth','can:admin.hours.edit');

Route::put('/hours/{id}', [HourController::class, 'update'])
    ->name('admin.hours.update')
    ->middleware('auth','can:admin.hours.update');

Route::get('/hours/{id}/delete', [HourController::class, 'destroy'])
    ->name('admin.hours.destroy')
    ->middleware('auth','can:admin.hours.destroy');

//ajax
Route::get('/hours/offices/{id}', [HourController::class, 'offices_data'])
    ->name('admin.hours.offices_data')
    ->middleware('auth','can:admin.hours.offices_data');

// rutas para el admin - configurations----------------------------------------------------------
Route::get('/configurations', [ConfigurationController::class, 'index'])
    ->name('admin.configurations.index')
    ->middleware('auth','can:admin.configurations.index');

Route::get('/configurations/create', [ConfigurationController::class, 'create'])
    ->name('admin.configurations.create')
    ->middleware('auth','can:admin.configurations.create');

Route::post('/configurations/create', [ConfigurationController::class, 'store'])
    ->name('admin.configurations.store')
    ->middleware('auth','can:admin.configurations.store');

Route::get('/configurations/{id}', [ConfigurationController::class, 'show'])
    ->name('admin.configurations.show')
    ->middleware('auth','can:admin.configurations.show');

Route::get('/configurations/{id}/edit', [ConfigurationController::class, 'edit'])
    ->name('admin.configurations.edit')
    ->middleware('auth','can:admin.configurations.edit');

Route::put('/configurations/{id}', [ConfigurationController::class, 'update'])
    ->name('admin.configurations.update')
    ->middleware('auth','can:admin.configurations.update');

Route::get('/configurations/{id}/delete', [ConfigurationController::class, 'destroy'])
    ->name('admin.configurations.destroy')
    ->middleware('auth','can:admin.configurations.destroy');

// rutas para el admin - historial----------------------------------------------------------
Route::get('/historial', [HistorialController::class, 'index'])
    ->name('admin.historial.index')
    ->middleware('auth','can:admin.historial.index');

Route::get('/historial/search_patient', [HistorialController::class, 'search_patient'])
    ->name('admin.historial.search_patient')
    ->middleware('auth', 'can:admin.historial.search_patient');

Route::get('/historial/create', [HistorialController::class, 'create'])
    ->name('admin.historial.create')
    ->middleware('auth','can:admin.historial.create');

Route::get('/historial/pdf/{id}', [HistorialController::class, 'pdf'])
    ->name('admin.historial.pdf')
    ->middleware('auth','can:admin.historial.pdf');

Route::post('/historial/create', [HistorialController::class, 'store'])
    ->name('admin.historial.store')
    ->middleware('auth','can:admin.historial.store');

Route::get('/historial/{id}', [HistorialController::class, 'show'])
    ->name('admin.historial.show')
    ->middleware('auth','can:admin.historial.show');

Route::get('/historial/{id}/edit', [HistorialController::class, 'edit'])
    ->name('admin.historial.edit')
    ->middleware('auth','can:admin.historial.edit');
    
Route::put('/historial/{id}', [HistorialController::class, 'update'])
    ->name('admin.historial.update')
    ->middleware('auth','can:admin.historial.update');

Route::get('/historial/{id}/delete', [HistorialController::class, 'destroy'])
    ->name('admin.historial.destroy')
    ->middleware('auth','can:admin.historial.destroy');

Route::get('/historial/patient/{id}', [HistorialController::class, 'print_historial'])
    ->name('admin.historial.print_historial')
    ->middleware('auth','can:admin.historial.print_historial');

//Reportes de reservaciones -----------------------
Route::get('/reservations/pdf', [EventController::class, 'pdf'])
    ->name('admin.reservations.pdf')
    ->middleware('auth','can:admin.reservations.pdf');

Route::get('/reservations/reports', [EventController::class, 'reports'])
    ->name('admin.reservations.reports')
    ->middleware('auth','can:admin.reservations.reports');

// rutas para el admin - payments--------------------
Route::get('/payments', [PaymentController::class, 'index'])
    ->name('admin.payments.index')
    ->middleware('auth','can:admin.payments.index');

Route::get('/payments/create', [PaymentController::class, 'create'])
    ->name('admin.payments.create')
    ->middleware('auth','can:admin.payments.create');



Route::get('/payments/report-pdf', [PaymentController::class, 'pdfReport'])->name('admin.payments.report.pdf')->middleware('auth','can:admin.payments.report.pdf');

Route::get('/payments/reports', [PaymentController::class, 'reports'])
    ->name('admin.payments.reports')
    ->middleware('auth','can:admin.payments.reports');
    
Route::post('/payments/create', [PaymentController::class, 'store'])
    ->name('admin.payments.store')
    ->middleware('auth','can:admin.payments.store');

Route::get('/payments/{id}', [PaymentController::class, 'show'])
    ->name('admin.payments.show')
    ->middleware('auth','can:admin.payments.show');

Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])
    ->name('admin.payments.edit')
    ->middleware('auth','can:admin.payments.edit');

Route::put('/payments/{id}', [PaymentController::class, 'update'])
    ->name('admin.payments.update')
    ->middleware('auth','can:admin.payments.update');

Route::get('/payments/{id}/delete', [PaymentController::class, 'destroy'])
    ->name('admin.payments.destroy')
    ->middleware('auth','can:admin.payments.destroy');

// Ruta para PDF individual de un pago
Route::get('/payments/{id}/pdf', [PaymentController::class, 'pdfIndividual'])->name('admin.payments.pdf') ->middleware('auth','can:admin.payments.pdf');

// Ruta para PDF de reportes





