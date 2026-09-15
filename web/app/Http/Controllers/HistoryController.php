<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();

        $query = $account ? $account->transactions() : Transaction::whereRaw('1=0');

        // Optional filter by type
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('transaction_type', $request->type);
        }

        // Search query
        if ($request->filled('search')) {
            $term = '%' . $request->search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('recipient_name', 'like', $term)
                  ->orWhere('reference_number', 'like', $term)
                  ->orWhere('biller_name', 'like', $term)
                  ->orWhere('payment_reference', 'like', $term);
            });
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('customer.history', compact('customer', 'account', 'transactions'));
    }

    public function detail(Request $request)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $ref = $request->query('ref');

        $transaction = Transaction::where('reference_number', $ref)->first();

        return view('customer.transaction-detail', compact('customer', 'transaction'));
    }
}
