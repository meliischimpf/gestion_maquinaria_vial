<?php

use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(MaintenanceController::class)->group(function () {

    // GET METHOD
    Route::get('/maintenances', 'index')->name('maintenances');
    Route::get('/maintenances/create', 'create')->name('maintenance.create');
    Route::get('/maintenances/edit/{id}', 'edit')->name('maintenance.edit');
    Route::get('/maintenances/show/{id}', 'show')->name('maintenance.show');
    Route::get('/maintenances/destroy/{id}', 'destroy')->name('maintenance.destroy');

    // POST METHOD
    Route::post('/maintenances/store', 'store')->name('maintenance.store');

    // PATCH METHOD
    Route::patch('/maintenances/update/{id}', 'update')->name('maintenance.update');

    // PUT METHOD
    
    // DELETE METHOD
});