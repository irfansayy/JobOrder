@extends('layouts.app')

@section('title', 'Edit Order Type')
@section('subtitle', 'Update order type information')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Current Info Card -->
    <div class="relative overflow-hidden rounded-xl shadow-md p-6 mb-6 text-white border border-slate-200">
        <div class="absolute inset-0 gradient-soft-slate opacity-90"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-white text-opacity-80 text-sm mb-1">Currently Editing</p>
                <h3 class="text-2xl font-bold drop-shadow-lg">{{ $orderType->name }}</h3>
                <p class="text-white text-opacity-80 text-sm mt-1">Code: {{ $orderType->code }}</p>
            </div>
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-list-alt text-3xl"></i>
            </div>
        </div>
    </div>

    <form action="{{ route('master-data.order-types.update', $orderType) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-list-alt text-teal-600 mr-2"></i>Order Type Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $orderType->name) }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('name') border-rose-500 @enderror"
                placeholder="e.g., Satuan, Retail, Team">
            @error('name')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="code" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-barcode text-teal-600 mr-2"></i>Order Type Code
            </label>
            <input type="text" name="code" id="code" value="{{ old('code', $orderType->code) }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('code') border-rose-500 @enderror"
                placeholder="e.g., SATUAN, RETAIL, TEAM">
            <p class="text-xs text-slate-500 mt-1">Use uppercase with underscores (e.g., MAKLOON_PRINT)</p>
            @error('code')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status Toggle -->
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <label class="flex items-center justify-between cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center {{ old('is_active', $orderType->is_active) ? 'bg-emerald-100' : 'bg-rose-100' }}">
                        <i class="fas text-xl {{ old('is_active', $orderType->is_active) ? 'fa-check-circle text-emerald-600' : 'fa-times-circle text-rose-600' }}"></i>
                    </div>
                    <div>
                        <span class="text-sm font-bold text-slate-700 block">Status</span>
                        <span class="text-xs text-slate-500">{{ old('is_active', $orderType->is_active) ? 'Order type is active' : 'Order type is inactive' }}</span>
                    </div>
                </div>
                <div class="relative">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ old('is_active', $orderType->is_active) ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-8 bg-slate-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-emerald-500"></div>
                </div>
            </label>
        </div>

        <!-- Statistics -->
        <div class="bg-gradient-to-r from-teal-50 to-emerald-50 rounded-lg p-4 border border-teal-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600 mb-1">
                        <i class="fas fa-clipboard-list text-teal-600 mr-2"></i>Total Orders Using This Type
                    </p>
                    <p class="text-3xl font-bold text-teal-700">{{ $orderType->jobOrders->count() }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500">Created</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $orderType->created_at->format('d M Y') }}</p>
                    <p class="text-xs text-slate-500 mt-2">Last Updated</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $orderType->updated_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('master-data.order-types.index') }}" 
               class="w-full sm:w-auto px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition duration-200 text-center">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                class="w-full sm:w-auto relative px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-save mr-2"></i>Update Order Type</span>
            </button>
        </div>
    </form>
</div>
@endsection