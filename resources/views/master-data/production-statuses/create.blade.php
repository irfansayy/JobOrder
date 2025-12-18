@extends('layouts.app')

@section('title', 'Create Production Status')
@section('subtitle', 'Add a new production status')

@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('master-data.production-statuses.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-cogs text-teal-600 mr-2"></i>Status Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
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
            <input type="text" name="code" id="code" value="{{ old('code') }}" required
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
            <input type="number" name="order_sequence" id="order_sequence" value="{{ old('order_sequence', 1) }}" required min="0"
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
                <option value="slate" {{ old('color') == 'slate' ? 'selected' : '' }}>Slate (Gray)</option>
                <option value="rose" {{ old('color') == 'rose' ? 'selected' : '' }}>Rose (Red)</option>
                <option value="amber" {{ old('color') == 'amber' ? 'selected' : '' }}>Amber (Yellow)</option>
                <option value="emerald" {{ old('color') == 'emerald' ? 'selected' : '' }}>Emerald (Green)</option>
                <option value="sky" {{ old('color') == 'sky' ? 'selected' : '' }}>Sky (Blue)</option>
                <option value="indigo" {{ old('color') == 'indigo' ? 'selected' : '' }}>Indigo</option>
                <option value="violet" {{ old('color') == 'violet' ? 'selected' : '' }}>Violet (Purple)</option>
                <option value="pink" {{ old('color') == 'pink' ? 'selected' : '' }}>Pink</option>
                <option value="orange" {{ old('color') == 'orange' ? 'selected' : '' }}>Orange</option>
                <option value="teal" {{ old('color') == 'teal' ? 'selected' : '' }}>Teal</option>
            </select>
            <p class="text-xs text-slate-500 mt-1">Choose a color for visual identification</p>
            @error('color')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color Preview -->
        <div id="colorPreview" class="hidden p-4 rounded-lg border-2 border-slate-200 bg-slate-50">
            <p class="text-sm font-semibold mb-3 text-slate-700">Color Preview:</p>
            <div class="flex items-center space-x-4">
                <div id="previewBox" class="w-16 h-16 rounded-lg shadow-md border-2"></div>
                <span id="previewBadge" class="px-4 py-2 rounded-full text-sm font-semibold border">Sample Status</span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('master-data.production-statuses.index') }}" 
               class="w-full sm:w-auto px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition duration-200 text-center">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                class="w-full sm:w-auto relative px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-save mr-2"></i>Create Status</span>
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('color').addEventListener('change', function() {
    const color = this.value;
    const preview = document.getElementById('colorPreview');
    const box = document.getElementById('previewBox');
    const badge = document.getElementById('previewBadge');
    
    if (color) {
        preview.classList.remove('hidden');
        box.className = `w-16 h-16 rounded-lg shadow-md bg-${color}-500 border-2 border-${color}-600`;
        badge.className = `px-4 py-2 rounded-full text-sm font-semibold bg-${color}-50 text-${color}-700 border border-${color}-200`;
    } else {
        preview.classList.add('hidden');
    }
});
</script>
@endsection