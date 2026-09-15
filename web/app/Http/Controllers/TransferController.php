<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Account;
use App\Models\Beneficiary;
use App\Services\TransferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TransferController extends Controller
{
    public function __construct(
        protected TransferService $transferService
    ) {}

    public function show()
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();
        $beneficiaries = $customer->beneficiaries()->orderBy('is_favorite', 'desc')->get();
        $limit = $customer->limits()->where('limit_type', 'duitnow')->first();
        $banks = \App\Models\Bank::active()->get();

        return view('customer.transfer', compact('customer', 'account', 'beneficiaries', 'limit', 'banks'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'recipient_name' => 'required|string|max:150',
            'recipient_bank' => 'required|string|max:100',
            'recipient_account' => 'nullable|string|max:50',
            'duitnow_id_type' => 'nullable|string',
            'duitnow_id_value' => 'nullable|string',
            'payment_reference' => 'nullable|string|max:100',
            'recipient_reference' => 'nullable|string|max:100',
            'save_payee' => 'nullable|boolean',
        ]);

        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        if ($customer->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Your account is currently frozen/suspended. Please contact customer support.',
            ], 403);
        }

        try {
            $result = $this->transferService->executeTransfer($customer, $validated);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json($result);
            }

            return redirect()->route('customer.history')->with('success', 'Transfer completed successfully!');
        } catch (Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return back()->withInput()->withErrors(['amount' => $e->getMessage()]);
        }
    }
}
