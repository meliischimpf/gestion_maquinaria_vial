<?php

use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(AssignmentController::class)->group(function () {

    // GET METHOD
    Route::get('/assignments', 'index')->name('assignments');
    Route::get('/assignments/create', 'create')->name('assignment.create');
    Route::get('/assignments/edit/{id}', 'edit')->name('assignment.edit');
    Route::get('/assignments/show/{id}', 'show')->name('assignment.show');
    
    // POST METHOD
    Route::post('/assignments/store', 'store')->name('assignment.store');
    
    // PATCH METHOD
    Route::patch('/assignments/update/{id}', 'update')->name('assignment.update');
    Route::patch('/assignments/destroy/{id}', 'destroy')->name('assignment.destroy');

    // PUT METHOD
    
    // DELETE METHOD
});