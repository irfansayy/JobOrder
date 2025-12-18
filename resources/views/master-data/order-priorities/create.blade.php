@extends('layouts.app')

@section('title', 'Create Order Priority')
@section('subtitle', 'Add a new order priority')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Info Card -->
    <div class="bg-gradient-to-r from-teal-50 to-emerald-50 border-l-4 border-teal-500 p-4 mb-6 rounded-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-teal-600 text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-slate-700">
                    <strong class="text-teal-700">Order Priorities</strong> help you categorize the urgency level of orders.
                    Available priorities: Normal and High
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('master-data.order-priorities.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-flag text-teal-600 mr-2"></i>Priority Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
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
            <input type="text" name="code" id="code" value="{{ old('code') }}" required
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
                <option value="sky" {{ old('color') == 'sky' ? 'selected' : '' }}>Sky Blue - Normal Priority</option>
                <option value="rose" {{ old('color') == 'rose' ? 'selected' : '' }}>Rose Red - High Priority</option>
            </select>
            @error('color')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            
            <!-- Color Preview -->
            <div class="mt-3 p-4 bg-slate-50 rounded-lg border border-slate-200" id="colorPreview" style="display: none;">
                <p class="text-sm text-slate-600 mb-2">Preview:</p>
                <span id="previewBadge" class="px-4 py-2 rounded-full text-sm font-bold border"></span>
            </div>
        </div>

        <!-- Quick Suggestions -->
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <p class="text-sm font-semibold text-slate-700 mb-3">
                <i class="fas fa-lightbulb text-amber-500 mr-2"></i>Quick Suggestions:
            </p>
            <div class="grid grid-cols-2 gap-3">
                <button type="button" onclick="fillForm('Normal', 'NORMAL', 'sky')" 
                    class="px-4 py-3 bg-white border-2 border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-sky-50 hover:border-sky-500 hover:text-sky-700 transition flex items-center justify-center space-x-2">
                    <i class="fas fa-circle text-sky-500"></i>
                    <span>Normal Priority</span>
                </button>
                <button type="button" onclick="fillForm('High', 'HIGH', 'rose')" 
                    class="px-4 py-3 bg-white border-2 border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-rose-50 hover:border-rose-500 hover:text-rose-700 transition flex items-center justify-center space-x-2">
                    <i class="fas fa-circle text-rose-500"></i>
                    <span>High Priority</span>
                </button>
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
                <span class="relative"><i class="fas fa-save mr-2"></i>Create Order Priority</span>
            </button>
        </div>
    </form>
</div>

<script>
function fillForm(name, code, color) {
    document.getElementById('name').value = name;
    document.getElementById('code').value = code;
    document.getElementById('color').value = color;
    
    // Update color preview
    updateColorPreview(color);
    
    // Add visual feedback
    const nameInput = document.getElementById('name');
    const codeInput = document.getElementById('code');
    const colorInput = document.getElementById('color');
    
    nameInput.classList.remove('border-slate-200');
    codeInput.classList.remove('border-slate-200');
    colorInput.classList.remove('border-slate-200');
    nameInput.classList.add('border-emerald-500');
    codeInput.classList.add('border-emerald-500');
    colorInput.classList.add('border-emerald-500');
    
    setTimeout(() => {
        nameInput.classList.remove('border-emerald-500');
        codeInput.classList.remove('border-emerald-500');
        colorInput.classList.remove('border-emerald-500');
        nameInput.classList.add('border-slate-200');
        codeInput.classList.add('border-slate-200');
        colorInput.classList.add('border-slate-200');
    }, 1000);
}

// Auto-generate code from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const code = name.toUpperCase().replace(/\s+/g, '_');
    document.getElementById('code').value = code;
});

// Color preview
document.getElementById('color').addEventListener('change', function() {
    updateColorPreview(this.value);
});

function updateColorPreview(color) {
    const preview = document.getElementById('colorPreview');
    const badge = document.getElementById('previewBadge');
    
    if (color) {
        preview.style.display = 'block';
        badge.textContent = document.getElementById('name').value || 'Priority Name';
        
        // Remove all color classes
        badge.className = 'px-4 py-2 rounded-full text-sm font-bold border';
        
        // Add appropriate color class
        const colorClasses = {
            'sky': 'bg-sky-500 text-white border-sky-600',
            'rose': 'bg-rose-500 text-white border-rose-600'
        };
        
        badge.className += ' ' + colorClasses[color];
    } else {
        preview.style.display = 'none';
    }
}

// Update preview when name changes
document.getElementById('name').addEventListener('input', function() {
    const color = document.getElementById('color').value;
    if (color) {
        updateColorPreview(color);
    }
});
</script>
@endsection