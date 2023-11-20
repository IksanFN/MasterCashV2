<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PaymentCashController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PaymentAccountController;
use App\Http\Controllers\PaymentTransferController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Route users
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

    // Route Students
    Route::prefix('students')->name('students.')->group(function() {
        Route::controller(StudentController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/detail/{user:uuid}', 'show')->name('detail');
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

    // Route Roles
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

    // Route Permissions
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

    // Route Bills
    Route::prefix('bills')->name('bills.')->group(function() {
        Route::controller(BillController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create-by-classroom', 'createByClassroom')->name('create_by_classroom');
            Route::post('/create-by-classroom', 'storeByClassroom')->name('store_by_classroom');
        });
    });

    // Route Checkout Cash
    Route::prefix('checkouts-cash')->name('checkouts_cash.')->group(function() {
        Route::controller(PaymentCashController::class)->group(function() {
            Route::get('/checkout/{uuid}', 'checkoutCash')->name('index');
            Route::put('/checkout/{uuid}', 'paymentCash')->name('store');
        });
    });

    Route::prefix('transactions')->name('transactions.')->group(function() {

        // Route Payment Transfer
        Route::controller(PaymentTransferController::class)->name('payment_transfer.')->group(function() {
            Route::get('/checkout-transfer/{uuid}', 'checkoutTransfer')->name('checkout');
            Route::put('/checkout-transfer/{uuid}', 'paymentTransfer')->name('store_checkout');
        });

        // Route Transaction
        Route::controller(TransactionController::class)->group(function() {
            Route::get('/paid', 'paid')->name('paid');
            Route::get('/waiting', 'waitingConfirm')->name('waiting');
            Route::put('/confirm/{transaction:uuid}', 'storeConfirm')->name('store_confirm');
            Route::get('/cancel', 'cancel')->name('cancel');
            Route::put('/cancel/{transaction:uuid}', 'storeCancel')->name('store_cancel');
            // Route::put('/', 'paymentCash')->name('store');
            Route::get('/invoice/{uuid}', 'invoice')->name('invoice');
            Route::get('/pdf/{transaction:uuid}', 'exportPdf')->name('pdf');
        });
    });

    // Route Payment Accounts
    Route::prefix('payment-accounts')->name('payment_accounts.')->group(function() {
        Route::controller(PaymentAccountController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{payment_account:uuid}', 'edit')->name('edit');
            Route::put('/edit/{payment_account:uuid}', 'update')->name('update');
            Route::delete('/delete/{payment_account:uuid}', 'destroy')->name('destroy');
        });
    });

    // Route Years
    Route::prefix('years')->name('years.')->group(function() {
        Route::controller(YearController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{year}', 'edit')->name('edit');
            Route::put('/edit/{year}', 'update')->name('update');
            Route::delete('/delete/{year}', 'destroy')->name('destroy');
        });
    });

    // Route Announcements
    Route::prefix('announcements')->name('announcements.')->group(function() {
        Route::controller(AnnouncementController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{announcement}', 'edit')->name('edit');
            Route::put('/edit/{announcement}', 'update')->name('update');
            Route::delete('/delete/{announcement}', 'destroy')->name('destroy');
        });
    });
    
    // Route Reports
    Route::prefix('reports')->name('reports.')->group(function() {
        Route::get('/', ReportController::class)->name('index');
    });

    // Route Expense
    Route::prefix('expenses')->name('expenses.')->group(function() {
        Route::controller(ExpenseController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/detail/{expense}', 'detail')->name('detail');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{expense}', 'edit')->name('edit');
            Route::put('/edit/{expense}', 'update')->name('update');
            Route::delete('/delete/{expense}', 'destroy')->name('destroy');
        });
    });

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
