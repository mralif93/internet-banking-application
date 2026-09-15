<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends Controller
{
    /**
     * List all beneficiaries for authenticated customer
     */
    public function index(Request $request)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $beneficiaries = $customer->beneficiaries()
            ->orderByDesc('is_favorite')
            ->orderByDesc('last_transferred_at')
            ->orderBy('nickname')
            ->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $beneficiaries,
            ]);
        }

        return response()->json(['success' => true, 'data' => $beneficiaries]);
    }

    /**
     * Store a new beneficiary
     */
    public function store(Request $request)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'nickname' => 'required|string|max:100',
            'bank_name' => 'required|string|max:100',
            'account_number' => 'nullable|string|max:50',
            'duitnow_id_type' => 'nullable|string|in:mobile,nric,passport,army_police,business_reg',
            'duitnow_id_value' => 'nullable|string|max:100',
            'is_favorite' => 'nullable|boolean',
        ]);

        if (empty($validated['account_number']) && empty($validated['duitnow_id_value'])) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide either a bank account number or a DuitNow ID.',
            ], 422);
        }

        $beneficiary = $customer->beneficiaries()->create([
            'nickname' => $validated['nickname'],
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'] ?? null,
            'duitnow_id_type' => $validated['duitnow_id_type'] ?? null,
            'duitnow_id_value' => $validated['duitnow_id_value'] ?? null,
            'is_favorite' => $request->boolean('is_favorite'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payee added successfully.',
            'data' => $beneficiary,
        ], 201);
    }

    /**
     * Toggle favorite status
     */
    public function toggleFavorite(Request $request, $id)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $beneficiary = $customer->beneficiaries()->findOrFail($id);

        $beneficiary->update([
            'is_favorite' => !$beneficiary->is_favorite,
        ]);

        return response()->json([
            'success' => true,
            'message' => $beneficiary->is_favorite ? 'Payee marked as favorite.' : 'Payee unmarked from favorites.',
            'is_favorite' => $beneficiary->is_favorite,
        ]);
    }

    /**
     * Delete a beneficiary
     */
    public function destroy($id)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $beneficiary = $customer->beneficiaries()->findOrFail($id);
        $beneficiary->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payee deleted successfully.',
        ]);
    }
}
