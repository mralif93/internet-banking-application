<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerAuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Customer Authentication Routes
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// Customer Protected Dashboard Routes
Route::middleware(['auth:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('dashboard');

    Route::get('/transfer', function () {
        return view('customer.transfer');
    })->name('transfer');

    Route::get('/jompay', function () {
        return view('customer.jompay');
    })->name('jompay');

    Route::get('/qr-pay', function () {
        return view('customer.qr-pay');
    })->name('qr-pay');

    Route::get('/statement', function () {
        return view('customer.statement');
    })->name('statement');

    Route::get('/transactions/detail', function () {
        return view('customer.transaction-detail');
    })->name('transactions.detail');

    Route::get('/history', function () {
        return view('customer.history');
    })->name('history');

    Route::get('/cards', function () {
        return view('customer.cards');
    })->name('cards');

    Route::get('/settings', function () {
        return view('customer.settings');
    })->name('settings');
});

// Also allow convenient direct /dashboard redirecting to customer.dashboard
Route::get('/dashboard', function () {
    return redirect()->route('customer.dashboard');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');

Route::get('/staff', function () {
    return view('staff');
})->name('staff');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/ui-kit', function () {
    return view('ui-kit');
})->name('ui-kit');



