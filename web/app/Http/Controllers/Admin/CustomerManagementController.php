<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
{
    /**
     * Display customer accounts
     */
    public function index(Request $request)
    {
        $query = Customer::with(['accounts', 'cards', 'limits']);

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('nric', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $customers = $query->paginate(15);

        return view('admin.customers', compact('customers'));
    }

    /**
     * Freeze or unfreeze a customer account
     */
    public function toggleStatus(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $newStatus = $customer->status === 'active' ? 'suspended' : 'active';
        $accountStatus = $newStatus === 'active' ? 'active' : 'frozen';

        $customer->update(['status' => $newStatus]);
        $customer->accounts()->update(['status' => $accountStatus]);
        $customer->cards()->update(['status' => $accountStatus]);

        AuditLog::create([
            'customer_id' => $customer->id,
            'event' => $newStatus === 'suspended' ? 'ADMIN_CUSTOMER_SUSPENDED' : 'ADMIN_CUSTOMER_REACTIVATED',
            'details' => [
                'admin' => 'Farhan Azman',
                'reason' => $request->input('reason', 'Administrative intervention / AML review'),
            ],
            'ip_address' => $request->ip() ?? '127.0.0.1',
            'user_agent' => $request->userAgent() ?? 'Admin Portal',
        ]);

        return response()->json([
            'success' => true,
            'message' => "Customer {$customer->name} status changed to {$newStatus}.",
            'status' => $newStatus,
        ]);
    }
}
