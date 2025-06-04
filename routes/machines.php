<?php

use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(MachineController::class)->group(function () {

    // GET METHOD
    Route::get('/machines', 'index')->name('machines');
    Route::get('/machines/create', 'create')->name('machine.create');
    Route::get('/machines/edit/{id}', 'edit')->name('machine.edit');
    Route::get('/machines/show/{id}', 'show')->name('machine.show');
    Route::get('/machines/destroy/{id}', 'destroy')->name('machine.destroy');

    // POST METHOD
    Route::post('/machines/store', 'store')->name('machine.store');

    // PATCH METHOD
    Route::patch('/machines/update/{id}', 'update')->name('machine.update');

    // PUT METHOD
    
    // DELETE METHOD
});