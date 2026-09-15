<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemParameter;
use App\Models\JompayBiller;
use App\Services\SystemParameterService;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function __construct(
        protected SystemParameterService $parameterService
    ) {}

    /**
     * Show parameter management center
     */
    public function index()
    {
        $parameters = $this->parameterService->getAllGrouped();
        $billers = JompayBiller::orderBy('biller_code')->get();
        $banks = \App\Models\Bank::orderBy('display_order')->orderBy('short_name')->get();

        return view('admin.parameters', compact('parameters', 'billers', 'banks'));
    }

    /**
     * Update an individual or bulk system parameters
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'parameters' => 'required|array',
            'parameters.*' => 'nullable',
        ]);

        $updatedCount = 0;
        foreach ($validated['parameters'] as $key => $val) {
            $this->parameterService->set($key, $val, 'Admin (Farhan Azman)');
            $updatedCount++;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Successfully updated {$updatedCount} system parameters.",
            ]);
        }

        return back()->with('success', "Successfully updated {$updatedCount} system parameters.");
    }

    /**
     * Toggle or create JomPAY Biller
     */
    public function storeBiller(Request $request)
    {
        $validated = $request->validate([
            'biller_code' => 'required|string|max:10|unique:jompay_billers,biller_code',
            'biller_name' => 'required|string|max:150',
            'category' => 'required|string|max:100',
            'ref_1_label' => 'required|string|max:100',
            'ref_2_label' => 'nullable|string|max:100',
            'is_ref_2_required' => 'nullable|boolean',
        ]);

        $biller = JompayBiller::create([
            'biller_code' => $validated['biller_code'],
            'biller_name' => $validated['biller_name'],
            'category' => $validated['category'],
            'ref_1_label' => $validated['ref_1_label'],
            'ref_2_label' => $validated['ref_2_label'] ?? null,
            'is_ref_2_required' => $request->boolean('is_ref_2_required'),
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'JomPAY biller registered successfully.',
            'data' => $biller,
        ], 201);
    }

    /**
     * Toggle JomPAY Biller active state
     */
    public function toggleBiller($id)
    {
        $biller = JompayBiller::findOrFail($id);
        $biller->update([
            'is_active' => !$biller->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => $biller->is_active ? 'Biller enabled.' : 'Biller disabled.',
            'is_active' => $biller->is_active,
        ]);
    }

    /**
     * Register a new Bank Institution
     */
    public function storeBank(Request $request)
    {
        $validated = $request->validate([
            'bank_code' => 'required|string|max:20|unique:banks,bank_code',
            'bank_name' => 'required|string|max:150',
            'short_name' => 'required|string|max:50',
            'swift_code' => 'nullable|string|max:20',
            'display_order' => 'nullable|integer',
        ]);

        $bank = \App\Models\Bank::create([
            'bank_code' => strtoupper($validated['bank_code']),
            'bank_name' => $validated['bank_name'],
            'short_name' => $validated['short_name'],
            'swift_code' => !empty($validated['swift_code']) ? strtoupper($validated['swift_code']) : null,
            'display_order' => $validated['display_order'] ?? 20,
            'is_duitnow_active' => true,
            'is_ibg_active' => true,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Banking institution registered successfully.',
            'data' => $bank,
        ], 201);
    }

    /**
     * Toggle Bank Institution active state or individual rails
     */
    public function toggleBank($id)
    {
        $bank = \App\Models\Bank::findOrFail($id);
        $bank->update([
            'is_active' => !$bank->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => $bank->is_active ? "{$bank->short_name} routing enabled." : "{$bank->short_name} routing disabled.",
            'is_active' => $bank->is_active,
        ]);
    }

    /**
     * Dedicated JomPAY Biller Directory Management
     */
    public function jompay(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');
        $status = $request->query('status');

        $query = JompayBiller::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('biller_code', 'like', "%{$search}%")
                  ->orWhere('biller_name', 'like', "%{$search}%")
                  ->orWhere('ref_1_label', 'like', "%{$search}%");
            });
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'disabled') {
            $query->where('is_active', false);
        }

        $billers = $query->orderBy('biller_code')->get();
        $categories = JompayBiller::distinct()->pluck('category')->filter()->values();

        $stats = [
            'total' => JompayBiller::count(),
            'active' => JompayBiller::where('is_active', true)->count(),
            'disabled' => JompayBiller::where('is_active', false)->count(),
            'categories_count' => $categories->count(),
        ];

        return view('admin.jompay', compact('billers', 'categories', 'stats', 'search', 'category', 'status'));
    }

    /**
     * Dedicated PayNet Participating Banks Management
     */
    public function banks(Request $request)
    {
        $search = $request->query('search');
        $rail = $request->query('rail');
        $status = $request->query('status');

        $query = \App\Models\Bank::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('bank_code', 'like', "%{$search}%")
                  ->orWhere('bank_name', 'like', "%{$search}%")
                  ->orWhere('short_name', 'like', "%{$search}%")
                  ->orWhere('swift_code', 'like', "%{$search}%");
            });
        }

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'offline') {
            $query->where('is_active', false);
        }

        if ($rail === 'duitnow') {
            $query->where('is_duitnow_active', true);
        } elseif ($rail === 'ibg') {
            $query->where('is_ibg_active', true);
        }

        $banks = $query->orderBy('display_order')->orderBy('short_name')->get();

        $stats = [
            'total' => \App\Models\Bank::count(),
            'active' => \App\Models\Bank::where('is_active', true)->count(),
            'offline' => \App\Models\Bank::where('is_active', false)->count(),
            'duitnow_active' => \App\Models\Bank::where('is_duitnow_active', true)->count(),
            'ibg_active' => \App\Models\Bank::where('is_ibg_active', true)->count(),
        ];

        return view('admin.banks', compact('banks', 'stats', 'search', 'rail', 'status'));
    }
}
