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
        /** @var \App\Models\Customer $customer */
        $customer = \Illuminate\Support\Facades\Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();
        $recentTransactions = $account ? $account->transactions()->take(10)->get() : collect();
        $limits = $customer->limits()->get();
        return view('customer.dashboard', compact('customer', 'account', 'recentTransactions', 'limits'));
    })->name('dashboard');

    // DuitNow Transfer
    Route::get('/transfer', [\App\Http\Controllers\TransferController::class, 'show'])->name('transfer');
    Route::post('/transfer', [\App\Http\Controllers\TransferController::class, 'submit'])->name('transfer.submit');

    // Beneficiaries Management
    Route::get('/beneficiaries', [\App\Http\Controllers\BeneficiaryController::class, 'index'])->name('beneficiaries.index');
    Route::post('/beneficiaries', [\App\Http\Controllers\BeneficiaryController::class, 'store'])->name('beneficiaries.store');
    Route::post('/beneficiaries/{id}/favorite', [\App\Http\Controllers\BeneficiaryController::class, 'toggleFavorite'])->name('beneficiaries.favorite');
    Route::delete('/beneficiaries/{id}', [\App\Http\Controllers\BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');

    // JomPAY
    Route::get('/jompay', [\App\Http\Controllers\JomPayController::class, 'show'])->name('jompay');
    Route::get('/jompay/validate-biller', [\App\Http\Controllers\JomPayController::class, 'validateBiller'])->name('jompay.validate');
    Route::post('/jompay', [\App\Http\Controllers\JomPayController::class, 'submit'])->name('jompay.submit');

    // QR Pay
    Route::get('/qr-pay', [\App\Http\Controllers\QrPayController::class, 'show'])->name('qr-pay');
    Route::post('/qr-pay', [\App\Http\Controllers\QrPayController::class, 'submit'])->name('qr-pay.submit');

    // Statements
    Route::get('/statement', [\App\Http\Controllers\StatementController::class, 'show'])->name('statement');
    Route::get('/statement/export', [\App\Http\Controllers\StatementController::class, 'export'])->name('statement.export');

    // History & Detail
    Route::get('/history', [\App\Http\Controllers\HistoryController::class, 'index'])->name('history');
    Route::get('/transactions/detail', [\App\Http\Controllers\HistoryController::class, 'detail'])->name('transactions.detail');

    // Cards
    Route::get('/cards', function () {
        /** @var \App\Models\Customer $customer */
        $customer = \Illuminate\Support\Facades\Auth::guard('customer')->user();
        $cards = $customer->cards()->get();
        $account = $customer->accounts()->where('status', 'active')->first();
        return view('customer.cards', compact('customer', 'cards', 'account'));
    })->name('cards');

    // Settings & Security
    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'show'])->name('settings');
    Route::post('/settings/limits', [\App\Http\Controllers\SettingsController::class, 'updateLimits'])->name('settings.limits');
    Route::post('/settings/kill-switch', [\App\Http\Controllers\SettingsController::class, 'activateKillSwitch'])->name('settings.kill-switch');
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



