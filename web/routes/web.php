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

// Admin Portal Authentication & Management Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Guest Routes
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Admin Protected Routes
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // System Parameters
        Route::get('/parameters', [\App\Http\Controllers\Admin\ParameterController::class, 'index'])->name('parameters');
        Route::post('/parameters', [\App\Http\Controllers\Admin\ParameterController::class, 'update'])->name('parameters.update');
        Route::post('/parameters/biller', [\App\Http\Controllers\Admin\ParameterController::class, 'storeBiller'])->name('parameters.biller.store');
        Route::post('/parameters/biller/{id}/toggle', [\App\Http\Controllers\Admin\ParameterController::class, 'toggleBiller'])->name('parameters.biller.toggle');
        Route::post('/parameters/bank', [\App\Http\Controllers\Admin\ParameterController::class, 'storeBank'])->name('parameters.bank.store');
        Route::post('/parameters/bank/{id}/toggle', [\App\Http\Controllers\Admin\ParameterController::class, 'toggleBank'])->name('parameters.bank.toggle');

        // Dedicated Gateway Operations: JomPAY Biller Directory & PayNet Banks
        Route::get('/jompay', [\App\Http\Controllers\Admin\ParameterController::class, 'jompay'])->name('jompay');
        Route::get('/banks', [\App\Http\Controllers\Admin\ParameterController::class, 'banks'])->name('banks');

        // Customer Account Controls
        Route::get('/customers', [\App\Http\Controllers\Admin\CustomerManagementController::class, 'index'])->name('customers');
        Route::post('/customers/{id}/toggle-status', [\App\Http\Controllers\Admin\CustomerManagementController::class, 'toggleStatus'])->name('customers.toggle-status');

        // Immutable Audit Trail
        Route::get('/audit-logs', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('audit-logs');
    });
});

Route::get('/ui-kit', function () {
    return view('ui-kit');
})->name('ui-kit');



