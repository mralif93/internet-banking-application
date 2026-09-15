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

        return view('admin.parameters', compact('parameters', 'billers'));
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
}
