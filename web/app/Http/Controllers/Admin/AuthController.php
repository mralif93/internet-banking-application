<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show high-security Admin login form.
     */
    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Authenticate admin user.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginInput = $credentials['login'];
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $authCredentials = [
            $fieldType => $loginInput,
            'password' => $credentials['password'],
            'is_active' => true,
        ];

        if (Auth::guard('web')->attempt($authCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::guard('web')->user();
            $user->update(['last_login_at' => now()]);

            AuditLog::record(
                event: 'ADMIN_LOGIN_SUCCESS',
                severity: 'info',
                actor: "Admin: {$user->name} ({$user->role})",
                ipAddress: $request->ip(),
                metadata: [
                    'user_id' => $user->id,
                    'employee_id' => $user->employee_id,
                    'role' => $user->role,
                    'department' => $user->department,
                ]
            );

            return redirect()->intended(route('admin.dashboard'));
        }

        AuditLog::record(
            event: 'ADMIN_LOGIN_FAILED',
            severity: 'warning',
            actor: "Unauthenticated: {$loginInput}",
            ipAddress: $request->ip(),
            metadata: ['attempted_login' => $loginInput]
        );

        throw ValidationException::withMessages([
            'login' => ['Invalid enterprise clearance credentials or account suspended.'],
        ]);
    }

    /**
     * Destroy authenticated session.
     */
    public function logout(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::guard('web')->user();

        if ($user) {
            AuditLog::record(
                event: 'ADMIN_LOGOUT',
                severity: 'info',
                actor: "Admin: {$user->name} ({$user->role})",
                ipAddress: $request->ip(),
                metadata: ['user_id' => $user->id]
            );
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Secure admin session terminated.');
    }
}

