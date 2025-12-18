@extends('layouts.app')

@section('title', 'Create Order Type')
@section('subtitle', 'Add a new order type')

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
                    <strong class="text-teal-700">Order Types</strong> help categorize different types of orders in your production system.
                    Examples: Satuan, Retail, Team, Makloon Print Press, Makloon Jahit
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('master-data.order-types.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                <i class="fas fa-list-alt text-teal-600 mr-2"></i>Order Type Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
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
            <input type="text" name="code" id="code" value="{{ old('code') }}" required
                class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('code') border-rose-500 @enderror"
                placeholder="e.g., SATUAN, RETAIL, TEAM">
            <p class="text-xs text-slate-500 mt-1">Use uppercase with underscores (e.g., MAKLOON_PRINT)</p>
            @error('code')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Quick Suggestions -->
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <p class="text-sm font-semibold text-slate-700 mb-3">
                <i class="fas fa-lightbulb text-amber-500 mr-2"></i>Quick Suggestions:
            </p>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" onclick="fillForm('Satuan', 'SATUAN')" 
                    class="px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-700 hover:bg-teal-50 hover:border-teal-500 hover:text-teal-700 transition">
                    <i class="fas fa-box mr-1"></i>Satuan
                </button>
                <button type="button" onclick="fillForm('Retail', 'RETAIL')" 
                    class="px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-700 hover:bg-teal-50 hover:border-teal-500 hover:text-teal-700 transition">
                    <i class="fas fa-store mr-1"></i>Retail
                </button>
                <button type="button" onclick="fillForm('Team', 'TEAM')" 
                    class="px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-700 hover:bg-teal-50 hover:border-teal-500 hover:text-teal-700 transition">
                    <i class="fas fa-users mr-1"></i>Team
                </button>
                <button type="button" onclick="fillForm('Makloon Print Press', 'MAKLOON_PRINT')" 
                    class="px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-700 hover:bg-teal-50 hover:border-teal-500 hover:text-teal-700 transition">
                    <i class="fas fa-print mr-1"></i>Makloon Print
                </button>
                <button type="button" onclick="fillForm('Makloon Jahit', 'MAKLOON_JAHIT')" 
                    class="px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-700 hover:bg-teal-50 hover:border-teal-500 hover:text-teal-700 transition col-span-2">
                    <i class="fas fa-cut mr-1"></i>Makloon Jahit
                </button>
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
                <span class="relative"><i class="fas fa-save mr-2"></i>Create Order Type</span>
            </button>
        </div>
    </form>
</div>

<script>
function fillForm(name, code) {
    document.getElementById('name').value = name;
    document.getElementById('code').value = code;
    
    // Add visual feedback
    const nameInput = document.getElementById('name');
    const codeInput = document.getElementById('code');
    
    nameInput.classList.remove('border-slate-200');
    codeInput.classList.remove('border-slate-200');
    nameInput.classList.add('border-emerald-500');
    codeInput.classList.add('border-emerald-500');
    
    setTimeout(() => {
        nameInput.classList.remove('border-emerald-500');
        codeInput.classList.remove('border-emerald-500');
        nameInput.classList.add('border-slate-200');
        codeInput.classList.add('border-slate-200');
    }, 1000);
}

// Auto-generate code from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const code = name.toUpperCase().replace(/\s+/g, '_');
    document.getElementById('code').value = code;
});
</script>
@endsection