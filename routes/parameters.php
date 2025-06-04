<?php

use App\Http\Controllers\ParameterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(ParameterController::class)->group(function () {

    // GET METHOD
    Route::get('/parameters', 'index')->name('parameters');
    Route::get('/parameters/create', 'create')->name('parameter.create');
    Route::get('/parameters/edit/{id}', 'edit')->name('parameter.edit');
    Route::get('/parameters/show/{id}', 'show')->name('parameter.show');
    
    // POST METHOD
    Route::post('/parameters/store', 'store')->name('parameter.store');
    
    // PATCH METHOD
    Route::patch('/parameters/update/{id}', 'update')->name('parameter.update');
    Route::patch('/parameters/destroy/{id}', 'destroy')->name('parameter.destroy');

    // PUT METHOD

    // DELETE METHOD
});