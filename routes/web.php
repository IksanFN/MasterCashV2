<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('users')->name('users.')->group(function() {
        Route::controller(UserController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{uuid}', 'edit')->name('edit');
            Route::put('/edit/{uuid}', 'update')->name('update');
            Route::delete('/delete/{uuid}', 'destroy')->name('destroy');
        });
    });

    Route::prefix('students')->name('students.')->group(function() {
        Route::controller(StudentController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{user:uuid}', 'edit')->name('edit');
            Route::put('/edit/{user:uuid}', 'update')->name('update');
            Route::delete('/delete/{user:uuid}', 'destroy')->name('destroy');
        });
    });

    Route::prefix('roles')->name('roles.')->group(function() {
        Route::controller(RoleController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{role:uuid}', 'edit')->name('edit');
            Route::put('/edit/{role:uuid}', 'update')->name('update');
            Route::delete('/delete/{role:uuid}', 'destroy')->name('destroy');
        });
    });
    
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

    Route::prefix('roles')->name('roles.')->group(function() {
        Route::controller(RoleController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{role:id}', 'edit')->name('edit');
            Route::put('/edit/{role:id}', 'update')->name('update');
            Route::delete('/delete/{role:id}', 'destroy')->name('destroy');
        });
    });

    Route::prefix('permissions')->name('permissions.')->group(function() {
        Route::controller(PermissionController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{permission:id}', 'edit')->name('edit');
            Route::put('/edit/{permission:id}', 'update')->name('update');
            Route::delete('/delete/{permission:id}', 'destroy')->name('destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
