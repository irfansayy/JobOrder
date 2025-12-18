<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\Brand;
use App\Models\CustomerService;
use App\Models\Product;
use App\Models\ProductionStatus;
use App\Models\OrderType;
use App\Models\OrderPriority;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobOrderController extends Controller
{
    public function index()
    {
        $jobOrders = JobOrder::with([
            'customerService',
            'brand',
            'client',
            'orderType',
            'product',
            'productionStatus',
            'orderPriority'
        ])->latest()->paginate(15);

        return view('job-orders.index', compact('jobOrders'));
    }

    public function create()
    {
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $customerServices = CustomerService::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        $productionStatuses = ProductionStatus::where('is_active', true)->orderBy('order_sequence')->get();
        $orderTypes = OrderType::where('is_active', true)->orderBy('name')->get();
        $orderPriorities = OrderPriority::where('is_active', true)->orderBy('name')->get();
        $orderCode = JobOrder::generateOrderCode();

        return view('job-orders.create', compact(
            'brands',
            'customerServices',
            'products',
            'productionStatuses',
            'orderTypes',
            'orderPriorities',
            'orderCode'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_date' => 'required|date',
            'customer_service_id' => 'required|exists:customer_services,id',
            'brand_id' => 'required|exists:brands,id',
            'client_name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'order_type_id' => 'required|exists:order_types,id',
            'product_id' => 'required|exists:products,id',
            'production_status_id' => 'required|exists:production_statuses,id',
            'order_priority_id' => 'required|exists:order_priorities,id',
            'deadline' => 'required|date|after_or_equal:order_date',
            'po_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png',
            'po_link' => 'nullable|url|max:500',
            'notes' => 'nullable|string|max:1000',
        ], [
            'deadline.after_or_equal' => 'Deadline harus sama atau setelah tanggal order.',
            'po_file.max' => 'Ukuran file maksimal 10MB.',
            'po_file.mimes' => 'File harus berformat PDF, DOC, DOCX, JPG, atau PNG.',
        ]);

        try {
            // Create or get client
            $client = Client::firstOrCreate(
                ['name' => trim($validated['client_name'])],
                ['is_active' => true]
            );

            // Handle file upload
            $poFile = null;
            if ($request->hasFile('po_file')) {
                $file = $request->file('po_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $poFile = $file->storeAs('po-files', $filename, 'public');
            }

            // Create job order
            JobOrder::create([
                'order_date' => $validated['order_date'],
                'order_code' => JobOrder::generateOrderCode(),
                'customer_service_id' => $validated['customer_service_id'],
                'brand_id' => $validated['brand_id'],
                'client_id' => $client->id,
                'qty' => $validated['qty'],
                'order_type_id' => $validated['order_type_id'],
                'product_id' => $validated['product_id'],
                'production_status_id' => $validated['production_status_id'],
                'order_priority_id' => $validated['order_priority_id'],
                'deadline' => $validated['deadline'],
                'po_file' => $poFile,
                'po_link' => $validated['po_link'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            return redirect()->route('job-orders.index')
                ->with('success', 'Job Order berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(JobOrder $jobOrder)
    {
        $jobOrder->load([
            'customerService',
            'brand',
            'client',
            'orderType',
            'product',
            'productionStatus',
            'orderPriority'
        ]);

        return view('job-orders.show', compact('jobOrder'));
    }

    public function edit(JobOrder $jobOrder)
    {
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $customerServices = CustomerService::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        $productionStatuses = ProductionStatus::where('is_active', true)->orderBy('order_sequence')->get();
        $orderTypes = OrderType::where('is_active', true)->orderBy('name')->get();
        $orderPriorities = OrderPriority::where('is_active', true)->orderBy('name')->get();

        return view('job-orders.edit', compact(
            'jobOrder',
            'brands',
            'customerServices',
            'products',
            'productionStatuses',
            'orderTypes',
            'orderPriorities'
        ));
    }

    public function update(Request $request, JobOrder $jobOrder)
    {
        $validated = $request->validate([
            'order_date' => 'required|date',
            'customer_service_id' => 'required|exists:customer_services,id',
            'brand_id' => 'required|exists:brands,id',
            'client_name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'order_type_id' => 'required|exists:order_types,id',
            'product_id' => 'required|exists:products,id',
            'production_status_id' => 'required|exists:production_statuses,id',
            'order_priority_id' => 'required|exists:order_priorities,id',
            'deadline' => 'required|date|after_or_equal:order_date',
            'po_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png',
            'po_link' => 'nullable|url|max:500',
            'notes' => 'nullable|string|max:1000',
            'remove_po_file' => 'nullable|boolean',
        ], [
            'deadline.after_or_equal' => 'Deadline harus sama atau setelah tanggal order.',
        ]);

        try {
            // Create or get client
            $client = Client::firstOrCreate(
                ['name' => trim($validated['client_name'])],
                ['is_active' => true]
            );

            $updateData = [
                'order_date' => $validated['order_date'],
                'customer_service_id' => $validated['customer_service_id'],
                'brand_id' => $validated['brand_id'],
                'client_id' => $client->id,
                'qty' => $validated['qty'],
                'order_type_id' => $validated['order_type_id'],
                'product_id' => $validated['product_id'],
                'production_status_id' => $validated['production_status_id'],
                'order_priority_id' => $validated['order_priority_id'],
                'deadline' => $validated['deadline'],
                'po_link' => $validated['po_link'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ];

            // Handle file removal
            if ($request->has('remove_po_file') && $request->remove_po_file) {
                if ($jobOrder->po_file) {
                    Storage::disk('public')->delete($jobOrder->po_file);
                }
                $updateData['po_file'] = null;
            }

            // Handle file upload
            if ($request->hasFile('po_file')) {
                // Delete old file
                if ($jobOrder->po_file) {
                    Storage::disk('public')->delete($jobOrder->po_file);
                }
                
                $file = $request->file('po_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $updateData['po_file'] = $file->storeAs('po-files', $filename, 'public');
            }

            // Update job order
            $jobOrder->update($updateData);

            return redirect()->route('job-orders.index')
                ->with('success', 'Job Order berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(JobOrder $jobOrder)
    {
        try {
            // Delete file if exists
            if ($jobOrder->po_file) {
                Storage::disk('public')->delete($jobOrder->po_file);
            }

            $jobOrder->delete();

            return redirect()->route('job-orders.index')
                ->with('success', 'Job Order berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}