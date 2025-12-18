<?php

namespace App\Http\Controllers;

use App\Models\OrderPriority;
use Illuminate\Http\Request;

class OrderPriorityController extends Controller
{
    public function index()
    {
        $orderPriorities = OrderPriority::latest()->paginate(15);
        return view('master-data.order-priorities.index', compact('orderPriorities'));
    }

    public function create()
    {
        return view('master-data.order-priorities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:order_priorities',
            'color' => 'required|string|max:20',
        ]);

        $validated['is_active'] = true;

        OrderPriority::create($validated);

        return redirect()->route('master-data.order-priorities.index')
            ->with('success', 'Order Priority created successfully.');
    }

    public function edit(OrderPriority $orderPriority)
    {
        return view('master-data.order-priorities.edit', compact('orderPriority'));
    }

    public function update(Request $request, OrderPriority $orderPriority)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:order_priorities,code,' . $orderPriority->id,
            'color' => 'required|string|max:20',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $orderPriority->update($validated);

        return redirect()->route('master-data.order-priorities.index')
            ->with('success', 'Order Priority updated successfully.');
    }

    public function destroy(OrderPriority $orderPriority)
    {
        $orderPriority->delete();

        return redirect()->route('master-data.order-priorities.index')
            ->with('success', 'Order Priority deleted successfully.');
    }
}