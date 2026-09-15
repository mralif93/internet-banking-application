<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display compliance audit logs
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('customer')->latest();

        if ($request->filled('event')) {
            $query->where('event', 'like', "%{$request->get('event')}%");
        }

        $logs = $query->paginate(25);

        return view('admin.audit-logs', compact('logs'));
    }
}
