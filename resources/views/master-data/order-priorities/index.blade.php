@extends('layouts.app')

@section('title', 'Order Priorities')
@section('subtitle', 'Manage order priority data')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-slate-600">Total: <span class="font-bold text-slate-800">{{ $orderPriorities->total() }}</span> order priorities</p>
    </div>
    <a href="{{ route('master-data.order-priorities.create') }}" 
       class="w-full sm:w-auto relative inline-flex items-center justify-center px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
        <span class="relative"><i class="fas fa-plus-circle mr-2"></i>Add New Order Priority</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    @forelse($orderPriorities as $priority)
    @php
        // Convert old colors to new
        $priorityColor = $priority->color;
        if ($priorityColor === 'blue') $priorityColor = 'sky';
        if ($priorityColor === 'red') $priorityColor = 'rose';
        
        $colorClasses = [
            'sky' => ['gradient' => 'gradient-soft-sky', 'text' => 'text-sky-600', 'badge' => 'bg-sky-500 border-sky-600'],
            'rose' => ['gradient' => 'gradient-soft-rose', 'text' => 'text-rose-600', 'badge' => 'bg-rose-500 border-rose-600']
        ];
        $colors = $colorClasses[$priorityColor] ?? $colorClasses['sky'];
    @endphp
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transform hover:scale-105 transition duration-300 border border-slate-200">
        <div class="relative overflow-hidden p-4">
            @if($priorityColor === 'sky')
                <div class="absolute inset-0 bg-gradient-to-r from-sky-400 to-sky-600 opacity-90"></div>
            @else
                <div class="absolute inset-0 bg-gradient-to-r from-rose-400 to-rose-600 opacity-90"></div>
            @endif
            <div class="relative flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-flag text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white drop-shadow-md">{{ $priority->name }}</h3>
                        <p class="text-white text-opacity-90 text-sm">{{ $priority->code }}</p>
                    </div>
                </div>
                @if($priority->is_active)
                    <span class="px-3 py-1 bg-emerald-500 text-white rounded-full text-xs font-bold shadow-md">
                        <i class="fas fa-check-circle mr-1"></i>Active
                    </span>
                @else
                    <span class="px-3 py-1 bg-slate-500 text-white rounded-full text-xs font-bold shadow-md">
                        <i class="fas fa-times-circle mr-1"></i>Inactive
                    </span>
                @endif
            </div>
            
            <!-- Color Badge Preview -->
            <div class="relative mt-4">
                <span class="inline-flex items-center px-4 py-2 {{ $colors['badge'] }} text-white rounded-full text-sm font-bold shadow-lg border-2">
                    <i class="fas fa-circle mr-2"></i>Priority Badge
                </span>
            </div>
        </div>
        
        <div class="p-6">
            <div class="mb-4">
                <div class="flex items-center justify-between text-sm text-slate-600 mb-2">
                    <span><i class="fas fa-calendar mr-2 {{ $colors['text'] }}"></i>Created</span>
                    <span class="font-semibold text-slate-700">{{ $priority->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm text-slate-600">
                    <span><i class="fas fa-sync mr-2 {{ $colors['text'] }}"></i>Updated</span>
                    <span class="font-semibold text-slate-700">{{ $priority->updated_at->format('d M Y') }}</span>
                </div>
            </div>
            
            <div class="flex items-center justify-between pt-4 border-t border-slate-200">
                <span class="text-sm text-slate-500">
                    <i class="fas fa-clipboard-list mr-1"></i>
                    {{ $priority->jobOrders->count() }} Orders
                </span>
                <div class="flex space-x-2">
                    <a href="{{ route('master-data.order-priorities.edit', $priority) }}" 
                       class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 border border-emerald-200 transition" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('master-data.order-priorities.destroy', $priority) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this order priority?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 border border-rose-200 transition" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-2">
        <div class="bg-white rounded-xl shadow-md p-12 text-center border border-slate-200">
            <i class="fas fa-inbox text-6xl text-slate-300 mb-4"></i>
            <p class="text-slate-500 text-lg font-semibold mb-4">No order priorities found</p>
            <a href="{{ route('master-data.order-priorities.create') }}" class="relative inline-flex items-center px-6 py-3 text-white font-bold rounded-lg transition overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-plus-circle mr-2"></i>Create your first order priority</span>
            </a>
        </div>
    </div>
    @endforelse
</div>

<!-- Color Legend -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-slate-200">
    <h3 class="text-lg font-bold text-slate-800 mb-4">
        <i class="fas fa-palette mr-2 text-indigo-600"></i>Priority Color Guide
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="flex items-center space-x-3 p-4 bg-sky-50 rounded-lg border-2 border-sky-200">
            <div class="w-12 h-12 bg-sky-500 rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-flag text-white text-xl"></i>
            </div>
            <div>                
                <p class="text-sm text-slate-600">Sky Blue</p>
                <p class="font-bold text-slate-800">Normal Priority</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 p-4 bg-rose-50 rounded-lg border-2 border-rose-200">
            <div class="w-12 h-12 bg-rose-500 rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-flag text-white text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-slate-600">Rose Red</p>
                <p class="font-bold text-slate-800">High Priority</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    {{ $orderPriorities->links() }}
</div>

<style>
.gradient-soft-sky {
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
}

.gradient-soft-rose {
    background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
}
</style>
@endsection