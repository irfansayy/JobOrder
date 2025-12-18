<?php

namespace App\Http\Controllers;

use App\Models\OrderType;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    public function index()
    {
        $orderTypes = OrderType::latest()->paginate(15);
        return view('master-data.order-types.index', compact('orderTypes'));
    }

    public function create()
    {
        return view('master-data.order-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:order_types',
        ]);

        // Tambahkan is_active default jika tidak ada
        $validated['is_active'] = true;

        OrderType::create($validated);

        return redirect()->route('master-data.order-types.index')
            ->with('success', 'Order Type created successfully.');
    }

    public function show(OrderType $orderType)
    {
        return view('master-data.order-types.show', compact('orderType'));
    }

    public function edit(OrderType $orderType)
    {
        return view('master-data.order-types.edit', compact('orderType'));
    }

    public function update(Request $request, OrderType $orderType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:order_types,code,' . $orderType->id,
        ]);

        // Handle checkbox is_active
        $validated['is_active'] = $request->has('is_active');

        $orderType->update($validated);

        return redirect()->route('master-data.order-types.index')
            ->with('success', 'Order Type updated successfully.');
    }

    public function destroy(OrderType $orderType)
    {
        $orderType->delete();

        return redirect()->route('master-data.order-types.index')
            ->with('success', 'Order Type deleted successfully.');
    }
}