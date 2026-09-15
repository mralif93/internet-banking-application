<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Card;
use App\Services\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class SettingsController extends Controller
{
    public function __construct(
        protected SecurityService $securityService
    ) {}

    public function show()
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();
        $limits = $customer->limits()->pluck('daily_limit', 'limit_type')->toArray();
        $cards = $customer->cards()->get();

        return view('customer.settings', compact('customer', 'account', 'limits', 'cards'));
    }

    public function updateLimits(Request $request)
    {
        $validated = $request->validate([
            'duitnow' => 'nullable|numeric|min:100|max:50000',
            'jompay' => 'nullable|numeric|min:100|max:50000',
            'qr_pay' => 'nullable|numeric|min:50|max:10000',
            'atm_withdrawal' => 'nullable|numeric|min:100|max:10000',
        ]);

        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $this->securityService->updateDailyLimits($customer, $validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Daily limits updated successfully!']);
        }

        return back()->with('success', 'Daily limits updated successfully!');
    }

    public function activateKillSwitch(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        try {
            $this->securityService->activateKillSwitch($customer, $request->password);

            // Log the user out
            Auth::guard('customer')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('login'),
                    'message' => 'EMERGENCY KILL SWITCH ACTIVATED. Your accounts are frozen.',
                ]);
            }

            return redirect()->route('login')->with('status', 'EMERGENCY LOCKDOWN ACTIVATED: Your account and cards have been frozen immediately.');
        } catch (Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }

            return back()->withErrors(['kill_switch_password' => $e->getMessage()]);
        }
    }
}
