<?php

namespace App\Http\Controllers;

use App\Models\ProductionStatus;
use Illuminate\Http\Request;

class ProductionStatusController extends Controller
{
    public function index()
    {
        $productionStatuses = ProductionStatus::orderBy('order_sequence')->paginate(15);
        return view('master-data.production-statuses.index', compact('productionStatuses'));
    }

    public function create()
    {
        return view('master-data.production-statuses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:production_statuses',
            'order_sequence' => 'required|integer|min:0',
            'color' => 'required|string|max:20',
        ]);

        ProductionStatus::create($validated);

        return redirect()->route('master-data.production-statuses.index')
            ->with('success', 'Production Status created successfully.');
    }

    public function show(ProductionStatus $productionStatus)
    {
        return view('master-data.production-statuses.show', compact('productionStatus'));
    }

    public function edit(ProductionStatus $productionStatus)
    {
        return view('master-data.production-statuses.edit', compact('productionStatus'));
    }

    public function update(Request $request, ProductionStatus $productionStatus)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:production_statuses,code,' . $productionStatus->id,
            'order_sequence' => 'required|integer|min:0',
            'color' => 'required|string|max:20',
            'is_active' => 'boolean',
        ]);

        $productionStatus->update($validated);

        return redirect()->route('master-data.production-statuses.index')
            ->with('success', 'Production Status updated successfully.');
    }

    public function destroy(ProductionStatus $productionStatus)
    {
        $productionStatus->delete();

        return redirect()->route('master-data.production-statuses.index')
            ->with('success', 'Production Status deleted successfully.');
    }
}