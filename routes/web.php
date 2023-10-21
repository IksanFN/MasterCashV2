<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route with Auth
Route::middleware('auth')->group(function () {

    // Route Users
    Route::prefix('users')->name('users.')->group(function() {
        Route::controller(UserController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{user:uuid}', 'edit')->name('edit');
            Route::put('/edit/{user:uuid}', 'update')->name('update');
            Route::delete('/delete/{user:uuid}', 'destroy')->name('destroy');
        });
    });

    // Route Classrooms
    Route::prefix('classrooms')->name('classrooms.')->group(function() {
        Route::controller(ClassroomController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{classroom:id}', 'edit')->name('edit');
            Route::put('/edit/{classroom:id}', 'update')->name('update');
            Route::delete('/delete/{classroom:id}', 'destroy')->name('destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
