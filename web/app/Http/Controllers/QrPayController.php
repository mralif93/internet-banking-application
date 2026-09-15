<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\QrPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class QrPayController extends Controller
{
    public function __construct(
        protected QrPayService $qrPayService
    ) {}

    public function show()
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();
        $limit = $customer->limits()->where('limit_type', 'qr_pay')->first();

        return view('customer.qr-pay', compact('customer', 'account', 'limit'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'merchant_name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0.5',
            'merchant_ref' => 'nullable|string',
        ]);

        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        if ($customer->status !== 'active') {
            return response()->json(['success' => false, 'message' => 'Account is suspended.'], 403);
        }

        try {
            $result = $this->qrPayService->payQr($customer, $validated);
            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
