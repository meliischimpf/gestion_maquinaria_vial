<?php

use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(WorkController::class)->group(function () {

    // GET METHOD
    Route::get('/works', 'index')->name('works');
    Route::get('/works/create', 'create')->name('work.create');
    Route::get('/works/edit/{id}', 'edit')->name('work.edit');
    Route::get('/works/show/{id}', 'show')->name('work.show');
    
    // POST METHOD
    Route::post('/works/store', 'store')->name('work.store');
    
    // PATCH METHOD
    Route::patch('/works/update/{id}', 'update')->name('work.update');
    Route::patch('/works/destroy/{id}', 'destroy')->name('work.destroy');

    // PUT METHOD

    // DELETE METHOD
});