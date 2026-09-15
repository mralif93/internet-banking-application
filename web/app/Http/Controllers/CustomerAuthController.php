<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    /**
     * Show customer login view.
     */
    public function showLoginForm()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard');
        }

        return view('login');
    }

    /**
     * Process customer login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            /** @var Customer $customer */
            $customer = Auth::guard('customer')->user();

            if ($customer->status === 'suspended' || $customer->status === 'locked') {
                Auth::guard('customer')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'username' => 'Your internet banking access is currently suspended or locked. Please contact customer support.',
                ])->withInput($request->only('username'));
            }

            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided digital banking credentials do not match our records.',
        ])->withInput($request->only('username'));
    }

    /**
     * Log the customer out.
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been securely signed out.');
    }
}
