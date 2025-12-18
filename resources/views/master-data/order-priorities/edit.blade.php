@extends('layouts.app')

@section('title', 'Edit Order Priority')
@section('subtitle', 'Update order priority information')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Current Info Card -->
    <div class="relative overflow-hidden rounded-xl shadow-md p-6 mb-6 text-white border border-slate-200">
        <div class="absolute inset-0 gradient-soft-slate opacity-90"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-white text-opacity-80 text-sm mb-1">Currently Editing</p>
                <h3 class="text-2xl font-bold drop-shadow-lg">{{ $orderPriority->name }}</h3>
                <p class="text-white text-opacity-80 text-sm mt-1">Code: {{ $orderPriority->code }}</p>
            </div>
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-flag text-3xl"></i>
            </div>
        </div>
        <div class="relative mt-4">
            @php
                $colorClasses = [
                    'sky' => 'bg-sky-600 border-sky-700',
                    'rose' => 'bg-rose-500 border-rose-600',
                    'blue' => 'bg-sky-600 border-sky-700',
                    'red' => 'bg-rose-500 border-rose-600'
                ];
                $colorClass = $colorClasses[$orderPriority->color] ?? 'bg-sky-600 border-sky-700';
            @endphp
            <span class="inline-flex items-center px-4 py-2 {{ $colorClass }} text-white rounded-full text-sm font-bold border-2">
                <i class="fas fa-circle mr-2"></i>Current Color: {{ ucfirst($orderPriority->color) }}
            </span>
        </div>
    </div>

    <form action="{{ route('master-data.order-priorities.update', $orderPriority) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-flag text-teal-600 mr-2"></i>Priority Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $orderPriority->name) }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('name') border-rose-500 @enderror"
                placeholder="e.g., Normal, High">
            @error('name')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="code" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-barcode text-teal-600 mr-2"></i>Priority Code
            </label>
            <input type="text" name="code" id="code" value="{{ old('code', $orderPriority->code) }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('code') border-rose-500 @enderror"
                placeholder="e.g., NORMAL, HIGH">
            <p class="text-xs text-slate-500 mt-1">Use uppercase with underscores</p>
            @error('code')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="color" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-palette text-teal-600 mr-2"></i>Color Badge
            </label>
            <select name="color" id="color" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('color') border-rose-500 @enderror">
                <option value="">Select a color</option>
                <option value="sky" {{ old('color', $orderPriority->color) == 'sky' || old('color', $orderPriority->color) == 'blue' ? 'selected' : '' }}>Sky Blue - Normal Priority</option>
                <option value="rose" {{ old('color', $orderPriority->color) == 'rose' || old('color', $orderPriority->color) == 'red' ? 'selected' : '' }}>Rose Red - High Priority</option>
            </select>
            @error('color')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            
            <!-- Color Preview -->
            <div class="mt-3 p-4 bg-slate-50 rounded-lg border border-slate-200" id="colorPreview">
                <p class="text-sm text-slate-600 mb-2">Preview:</p>
                <span id="previewBadge" class="px-4 py-2 rounded-full text-sm font-bold border"></span>
            </div>
        </div>

        <!-- Status Toggle -->
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <label class="flex items-center justify-between cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center {{ old('is_active', $orderPriority->is_active) ? 'bg-emerald-100' : 'bg-rose-100' }}">
                        <i class="fas text-xl {{ old('is_active', $orderPriority->is_active) ? 'fa-check-circle text-emerald-600' : 'fa-times-circle text-rose-600' }}"></i>
                    </div>
                    <div>
                        <span class="text-sm font-bold text-slate-700 block">Status</span>
                        <span class="text-xs text-slate-500">{{ old('is_active', $orderPriority->is_active) ? 'Priority is active' : 'Priority is inactive' }}</span>
                    </div>
                </div>
                <div class="relative">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ old('is_active', $orderPriority->is_active) ? 'checked' : '' }}
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
                        <i class="fas fa-clipboard-list text-teal-600 mr-2"></i>Total Orders Using This Priority
                    </p>
                    <p class="text-3xl font-bold text-teal-700">{{ $orderPriority->jobOrders->count() }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500">Created</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $orderPriority->created_at->format('d M Y') }}</p>
                    <p class="text-xs text-slate-500 mt-2">Last Updated</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $orderPriority->updated_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('master-data.order-priorities.index') }}" 
               class="w-full sm:w-auto px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition duration-200 text-center">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                class="w-full sm:w-auto relative px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-save mr-2"></i>Update Order Priority</span>
            </button>
        </div>
    </form>
</div>

<script>
// Color preview on load
window.addEventListener('DOMContentLoaded', function() {
    let color = document.getElementById('color').value;
    // Convert old colors to new
    if (color === 'blue') color = 'sky';
    if (color === 'red') color = 'rose';
    updateColorPreview(color);
});

// Color preview on change
document.getElementById('color').addEventListener('change', function() {
    updateColorPreview(this.value);
});

// Update preview when name changes
document.getElementById('name').addEventListener('input', function() {
    const color = document.getElementById('color').value;
    if (color) {
        updateColorPreview(color);
    }
});

function updateColorPreview(color) {
    const badge = document.getElementById('previewBadge');
    
    if (color) {
        badge.textContent = document.getElementById('name').value || 'Priority Name';
        
        // Remove all color classes
        badge.className = 'px-4 py-2 rounded-full text-sm font-bold border';
        
        // Add appropriate color class
        const colorClasses = {
            'sky': 'bg-sky-500 text-white border-sky-600',
            'rose': 'bg-rose-500 text-white border-rose-600',
            'blue': 'bg-sky-500 text-white border-sky-600',
            'red': 'bg-rose-500 text-white border-rose-600'
        };
        
        badge.className += ' ' + (colorClasses[color] || colorClasses['sky']);
    }
}
</script>
@endsection