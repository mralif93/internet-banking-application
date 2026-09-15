<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\JompayBiller;
use App\Services\JomPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class JomPayController extends Controller
{
    public function __construct(
        protected JomPayService $jomPayService
    ) {}

    public function show()
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();
        $billers = JompayBiller::orderBy('category')->orderBy('biller_name')->get();
        $limit = $customer->limits()->where('limit_type', 'jompay')->first();

        return view('customer.jompay', compact('customer', 'account', 'billers', 'limit'));
    }

    public function validateBiller(Request $request)
    {
        $biller = $this->jomPayService->validateBiller($request->query('code', ''));

        if (!$biller) {
            return response()->json(['valid' => false, 'message' => 'Biller code not recognized']);
        }

        return response()->json([
            'valid' => true,
            'biller' => $biller,
        ]);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'biller_code' => 'required|string',
            'ref_1' => 'required|string|max:50',
            'ref_2' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:1',
        ]);

        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        if ($customer->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Account is frozen/suspended.',
            ], 403);
        }

        try {
            $result = $this->jomPayService->payBill($customer, $validated);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json($result);
            }

            return redirect()->route('customer.history')->with('success', 'JomPAY bill payment successful!');
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
