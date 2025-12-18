@extends('layouts.app')

@section('title', 'Edit Job Order')
@section('subtitle', 'Update job order information')

@section('content')
<div class="max-w-4xl mx-auto">
    @if(session('error'))
        <div class="mb-6 bg-gradient-to-r from-rose-50 to-pink-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-lg shadow-sm">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-xl text-rose-600"></i>
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('job-orders.update', $jobOrder) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order Date -->
            <div>
                <label for="order_date" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-calendar text-teal-600 mr-2"></i>Order Date
                </label>
                <input type="date" name="order_date" id="order_date" value="{{ old('order_date', $jobOrder->order_date->format('Y-m-d')) }}" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('order_date') border-rose-500 @enderror">
                @error('order_date')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order Code (Read Only) -->
            <div>
                <label for="order_code" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-barcode text-teal-600 mr-2"></i>Order Code
                </label>
                <input type="text" name="order_code" id="order_code" value="{{ $jobOrder->order_code }}" readonly
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg bg-slate-50 text-slate-600 cursor-not-allowed">
            </div>

            <!-- Customer Service -->
            <div>
                <label for="customer_service_id" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-user-tie text-teal-600 mr-2"></i>Customer Service
                </label>
                <select name="customer_service_id" id="customer_service_id" required
                    class="@error('customer_service_id') border-rose-500 @enderror">
                    <option value="">Select CS</option>
                    @foreach($customerServices as $cs)
                    <option value="{{ $cs->id }}" {{ old('customer_service_id', $jobOrder->customer_service_id) == $cs->id ? 'selected' : '' }}>
                        {{ $cs->name }}
                    </option>
                    @endforeach
                </select>
                @error('customer_service_id')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Brand -->
            <div>
                <label for="brand_id" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-tag text-teal-600 mr-2"></i>Brand
                </label>
                <select name="brand_id" id="brand_id" required
                    class="@error('brand_id') border-rose-500 @enderror">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $jobOrder->brand_id) == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
                @error('brand_id')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Client Name -->
            <div>
                <label for="client_name" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-user text-teal-600 mr-2"></i>Client Name
                </label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $jobOrder->client->name) }}" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('client_name') border-rose-500 @enderror"
                    placeholder="Enter client name">
                @error('client_name')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantity -->
            <div>
                <label for="qty" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-boxes text-teal-600 mr-2"></i>Quantity
                </label>
                <input type="number" name="qty" id="qty" value="{{ old('qty', $jobOrder->qty) }}" required min="1"
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('qty') border-rose-500 @enderror"
                    placeholder="Enter quantity">
                @error('qty')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order Type -->
            <div>
                <label for="order_type_id" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-list text-teal-600 mr-2"></i>Order Type
                </label>
                <select name="order_type_id" id="order_type_id" required
                    class="@error('order_type_id') border-rose-500 @enderror">
                    <option value="">Select Order Type</option>
                    @foreach($orderTypes as $type)
                    <option value="{{ $type->id }}" {{ old('order_type_id', $jobOrder->order_type_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                    @endforeach
                </select>
                @error('order_type_id')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Product -->
            <div>
                <label for="product_id" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-box text-teal-600 mr-2"></i>Product
                </label>
                <select name="product_id" id="product_id" required
                    class="@error('product_id') border-rose-500 @enderror">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $jobOrder->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} - Rp. {{ number_format($product->price, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
                @error('product_id')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Production Status -->
            <div>
                <label for="production_status_id" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-cogs text-teal-600 mr-2"></i>Production Status
                </label>
                <select name="production_status_id" id="production_status_id" required
                    class="@error('production_status_id') border-rose-500 @enderror">
                    <option value="">Select Status</option>
                    @foreach($productionStatuses as $status)
                    <option value="{{ $status->id }}" {{ old('production_status_id', $jobOrder->production_status_id) == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                    @endforeach
                </select>
                @error('production_status_id')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order Priority -->
            <div>
                <label for="order_priority_id" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-exclamation-circle text-teal-600 mr-2"></i>Priority
                </label>
                <select name="order_priority_id" id="order_priority_id" required
                    class="@error('order_priority_id') border-rose-500 @enderror">
                    <option value="">Select Priority</option>
                    @foreach($orderPriorities as $priority)
                    <option value="{{ $priority->id }}" {{ old('order_priority_id', $jobOrder->order_priority_id) == $priority->id ? 'selected' : '' }}>
                        {{ $priority->name }}
                    </option>
                    @endforeach
                </select>
                @error('order_priority_id')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deadline -->
            <div>
                <label for="deadline" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-calendar-check text-teal-600 mr-2"></i>Deadline
                </label>
                <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $jobOrder->deadline->format('Y-m-d')) }}" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('deadline') border-rose-500 @enderror">
                @error('deadline')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- PO File Upload -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="po_file" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-file-upload text-teal-600 mr-2"></i>Upload New PO File
                </label>
                @if($jobOrder->po_file)
                    <div class="mb-2 p-3 bg-teal-50 rounded-lg border border-teal-200">
                        <p class="text-sm text-teal-800">
                            <i class="fas fa-file mr-2"></i>Current file: 
                            <a href="{{ Storage::url($jobOrder->po_file) }}" target="_blank" class="underline hover:text-teal-600 font-semibold">
                                {{ basename($jobOrder->po_file) }}
                            </a>
                        </p>
                        <label class="flex items-center mt-2">
                            <input type="checkbox" name="remove_po_file" value="1" class="mr-2 text-teal-600 focus:ring-teal-500">
                            <span class="text-sm text-rose-600">Remove current file</span>
                        </label>
                    </div>
                @endif
                <input type="file" name="po_file" id="po_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('po_file') border-rose-500 @enderror">
                <p class="text-xs text-slate-500 mt-1">Max 10MB (PDF, DOC, DOCX, JPG, PNG)</p>
                @error('po_file')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PO Link -->
            <div>
                <label for="po_link" class="block text-sm font-bold text-slate-700 mb-2">
                    <i class="fas fa-link text-teal-600 mr-2"></i>PO Link
                </label>
                <input type="url" name="po_link" id="po_link" value="{{ old('po_link', $jobOrder->po_link) }}"
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('po_link') border-rose-500 @enderror"
                    placeholder="https://example.com/po-file">
                @error('po_link')
                <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-sticky-note text-teal-600 mr-2"></i>Notes (Optional)
            </label>
            <textarea name="notes" id="notes" rows="4"
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('notes') border-rose-500 @enderror"
                placeholder="Add any additional notes...">{{ old('notes', $jobOrder->notes) }}</textarea>
            @error('notes')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('job-orders.index') }}" 
               class="w-full sm:w-auto px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition duration-200 text-center">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                class="w-full sm:w-auto relative px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-save mr-2"></i>Update Job Order</span>
            </button>
        </div>
    </form>
</div>
@endsection