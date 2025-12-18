@extends('layouts.app')

@section('title', 'Edit Production Status')
@section('subtitle', 'Update production status information')

@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('master-data.production-statuses.update', $productionStatus) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-cogs text-teal-600 mr-2"></i>Status Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $productionStatus->name) }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('name') border-rose-500 @enderror"
                placeholder="e.g., Cutting, Sewing, Packing">
            @error('name')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="code" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-barcode text-teal-600 mr-2"></i>Status Code
            </label>
            <input type="text" name="code" id="code" value="{{ old('code', $productionStatus->code) }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('code') border-rose-500 @enderror"
                placeholder="e.g., CUTTING, SEWING, PACKING">
            <p class="text-xs text-slate-500 mt-1">Use uppercase with underscores (e.g., QUALITY_CHECK)</p>
            @error('code')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="order_sequence" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-sort-numeric-up text-teal-600 mr-2"></i>Order Sequence
            </label>
            <input type="number" name="order_sequence" id="order_sequence" value="{{ old('order_sequence', $productionStatus->order_sequence) }}" required min="0"
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('order_sequence') border-rose-500 @enderror"
                placeholder="Enter sequence number">
            <p class="text-xs text-slate-500 mt-1">Lower numbers appear first in the production flow</p>
            @error('order_sequence')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="color" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-palette text-teal-600 mr-2"></i>Status Color
            </label>
            <select name="color" id="color" required
                class="@error('color') border-rose-500 @enderror">
                <option value="">Select Color</option>
                <option value="slate" {{ old('color', $productionStatus->color) == 'slate' ? 'selected' : '' }}>Slate (Gray)</option>
                <option value="rose" {{ old('color', $productionStatus->color) == 'rose' ? 'selected' : '' }}>Rose (Red)</option>
                <option value="amber" {{ old('color', $productionStatus->color) == 'amber' ? 'selected' : '' }}>Amber (Yellow)</option>
                <option value="emerald" {{ old('color', $productionStatus->color) == 'emerald' ? 'selected' : '' }}>Emerald (Green)</option>
                <option value="sky" {{ old('color', $productionStatus->color) == 'sky' ? 'selected' : '' }}>Sky (Blue)</option>
                <option value="indigo" {{ old('color', $productionStatus->color) == 'indigo' ? 'selected' : '' }}>Indigo</option>
                <option value="violet" {{ old('color', $productionStatus->color) == 'violet' ? 'selected' : '' }}>Violet (Purple)</option>
                <option value="pink" {{ old('color', $productionStatus->color) == 'pink' ? 'selected' : '' }}>Pink</option>
                <option value="orange" {{ old('color', $productionStatus->color) == 'orange' ? 'selected' : '' }}>Orange</option>
                <option value="teal" {{ old('color', $productionStatus->color) == 'teal' ? 'selected' : '' }}>Teal</option>
            </select>
            <p class="text-xs text-slate-500 mt-1">Choose a color for visual identification</p>
            @error('color')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color Preview -->
        <div id="colorPreview" class="p-4 rounded-lg border-2 border-slate-200 bg-slate-50">
            <p class="text-sm font-semibold mb-3 text-slate-700">Color Preview:</p>
            <div class="flex items-center space-x-4">
                <div id="previewBox" class="w-16 h-16 rounded-lg shadow-md bg-{{ $productionStatus->color }}-500 border-2 border-{{ $productionStatus->color }}-600"></div>
                <span id="previewBadge" class="px-4 py-2 rounded-full text-sm font-semibold bg-{{ $productionStatus->color }}-50 text-{{ $productionStatus->color }}-700 border border-{{ $productionStatus->color }}-200">
                    {{ $productionStatus->name }}
                </span>
            </div>
        </div>

        <div>
            <label class="flex items-center space-x-3">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $productionStatus->is_active) ? 'checked' : '' }}
                    class="w-5 h-5 text-teal-600 border-slate-300 rounded focus:ring-teal-500">
                <span class="text-sm font-bold text-slate-700">
                    <i class="fas fa-check-circle text-emerald-600 mr-2"></i>Active
                </span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('master-data.production-statuses.index') }}" 
               class="w-full sm:w-auto px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition duration-200 text-center">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                class="w-full sm:w-auto relative px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-save mr-2"></i>Update Status</span>
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('color').addEventListener('change', function() {
    const color = this.value;
    const box = document.getElementById('previewBox');
    const badge = document.getElementById('previewBadge');
    
    if (color) {
        box.className = `w-16 h-16 rounded-lg shadow-md bg-${color}-500 border-2 border-${color}-600`;
        badge.className = `px-4 py-2 rounded-full text-sm font-semibold bg-${color}-50 text-${color}-700 border border-${color}-200`;
    }
});
</script>
@endsection