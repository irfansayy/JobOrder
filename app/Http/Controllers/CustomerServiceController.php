<?php

namespace App\Http\Controllers;

use App\Models\CustomerService;
use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    public function index()
    {
        $customerServices = CustomerService::latest()->paginate(15);
        return view('master-data.customer-services.index', compact('customerServices'));
    }

    public function create()
    {
        return view('master-data.customer-services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:customer_services',
            'code' => 'required|string|max:50|unique:customer_services',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->has('is_active');

        CustomerService::create($validated);

        return redirect()->route('master-data.customer-services.index')
            ->with('success', 'Customer Service created successfully.');
    }

    public function show(CustomerService $customerService)
    {
        return view('master-data.customer-services.show', compact('customerService'));
    }

    public function edit(CustomerService $customerService)
    {
        return view('master-data.customer-services.edit', compact('customerService'));
    }

    public function update(Request $request, CustomerService $customerService)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:customer_services,name,' . $customerService->id,
            'code' => 'required|string|max:50|unique:customer_services,code,' . $customerService->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $customerService->update($validated);

        return redirect()->route('master-data.customer-services.index')
            ->with('success', 'Customer Service updated successfully.');
    }

    public function destroy(CustomerService $customerService)
    {
        $customerService->delete();

        return redirect()->route('master-data.customer-services.index')
            ->with('success', 'Customer Service deleted successfully.');
    }
}