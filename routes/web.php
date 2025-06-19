<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RunningTextController;

Route::middleware(['role:superadmin'])->group(function () {
    Route::get('/manage-flights', [FlightController::class, 'index'])->name('manage.flights');
    Route::get('/flights/create', [FlightController::class, 'create'])->name('flights.create');
    Route::post('/flights', [FlightController::class, 'store'])->name('flights.store');
    Route::get('/flights/{id}/edit', [FlightController::class, 'edit'])->name('flights.edit');
    Route::put('/flights/{id}', [FlightController::class, 'update'])->name('flights.update');
    Route::delete('/flights/{id}', [FlightController::class, 'destroy'])->name('flights.destroy');



    Route::resource('/admin', AdminController::class)->except(['show']);
    Route::get('/admin/manage', [AdminController::class, 'index'])->name('admin.manage');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');



    Route::get('/runningtext/edit', [RunningTextController::class, 'edit'])->name('admin.runningtexts.edit');
    Route::put('/runningtext/update', [RunningTextController::class, 'update'])->name('admin.runningtexts.update');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/manage-flights', [FlightController::class, 'index'])->name('manage.flights');
    Route::get('/flights/create', [FlightController::class, 'create'])->name('flights.create');
    Route::post('/flights', [FlightController::class, 'store'])->name('flights.store');
    Route::get('/flights/{id}/edit', [FlightController::class, 'edit'])->name('flights.edit');
    Route::put('/flights/{id}', [FlightController::class, 'update'])->name('flights.update');
    Route::delete('/flights/{id}', [FlightController::class, 'destroy'])->name('flights.destroy');
});

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/jadwal', [PublicController::class, 'index'])->name('public.jadwal');
