@extends('layouts.app')

@section('title', 'Create Product')
@section('subtitle', 'Add a new product')

@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('master-data.products.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-box text-teal-600 mr-2"></i>Product Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('name') border-rose-500 @enderror"
                placeholder="Enter product name">
            @error('name')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="code" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-barcode text-teal-600 mr-2"></i>Product Code
            </label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('code') border-rose-500 @enderror"
                placeholder="Enter product code (e.g., PROD_001)">
            @error('code')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-money-bill-wave text-teal-600 mr-2"></i>Price (Rp)
            </label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('price') border-rose-500 @enderror"
                placeholder="Enter product price">
            @error('price')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-align-left text-teal-600 mr-2"></i>Description (Optional)
            </label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('description') border-rose-500 @enderror"
                placeholder="Enter product description">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="flex items-center space-x-3">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                    class="w-5 h-5 text-teal-600 border-slate-300 rounded focus:ring-teal-500">
                <span class="text-sm font-bold text-slate-700">
                    <i class="fas fa-check-circle text-emerald-600 mr-2"></i>Active
                </span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('master-data.products.index') }}" 
               class="w-full sm:w-auto px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition duration-200 text-center">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                class="w-full sm:w-auto relative px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-save mr-2"></i>Create Product</span>
            </button>
        </div>
    </form>
</div>
@endsection