@extends('layouts.app')

@section('title', 'Order Types')
@section('subtitle', 'Manage order type data')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-slate-600">Total: <span class="font-bold text-slate-800">{{ $orderTypes->total() }}</span> order types</p>
    </div>
    <a href="{{ route('master-data.order-types.create') }}" 
       class="w-full sm:w-auto relative inline-flex items-center justify-center px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
        <span class="relative"><i class="fas fa-plus-circle mr-2"></i>Add New Order Type</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    @forelse($orderTypes as $type)
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transform hover:scale-105 transition duration-300 border border-slate-200">
        <div class="relative overflow-hidden p-4">
            <div class="absolute inset-0 gradient-soft-slate opacity-90"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-list-alt text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white drop-shadow-md">{{ $type->name }}</h3>
                        <p class="text-white text-opacity-80 text-sm">{{ $type->code }}</p>
                    </div>
                </div>
                @if($type->is_active)
                    <span class="px-3 py-1 bg-emerald-500 text-white rounded-full text-xs font-bold shadow-md">
                        <i class="fas fa-check-circle mr-1"></i>Active
                    </span>
                @else
                    <span class="px-3 py-1 bg-rose-500 text-white rounded-full text-xs font-bold shadow-md">
                        <i class="fas fa-times-circle mr-1"></i>Inactive
                    </span>
                @endif
            </div>
        </div>
        
        <div class="p-6">
            <div class="mb-4">
                <div class="flex items-center justify-between text-sm text-slate-600 mb-2">
                    <span><i class="fas fa-calendar mr-2 text-teal-600"></i>Created</span>
                    <span class="font-semibold text-slate-700">{{ $type->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm text-slate-600">
                    <span><i class="fas fa-sync mr-2 text-emerald-600"></i>Updated</span>
                    <span class="font-semibold text-slate-700">{{ $type->updated_at->format('d M Y') }}</span>
                </div>
            </div>
            
            <div class="flex items-center justify-between pt-4 border-t border-slate-200">
                <span class="text-sm text-slate-500">
                    <i class="fas fa-clipboard-list mr-1"></i>
                    {{ $type->jobOrders->count() }} Orders
                </span>
                <div class="flex space-x-2">
                    <a href="{{ route('master-data.order-types.edit', $type) }}" 
                       class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 border border-emerald-200 transition" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('master-data.order-types.destroy', $type) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this order type?');" class="inline">
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
    <div class="col-span-3">
        <div class="bg-white rounded-xl shadow-md p-12 text-center border border-slate-200">
            <i class="fas fa-inbox text-6xl text-slate-300 mb-4"></i>
            <p class="text-slate-500 text-lg font-semibold mb-4">No order types found</p>
            <a href="{{ route('master-data.order-types.create') }}" class="relative inline-flex items-center px-6 py-3 text-white font-bold rounded-lg transition overflow-hidden group">
                <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                <span class="relative"><i class="fas fa-plus-circle mr-2"></i>Create your first order type</span>
            </a>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $orderTypes->links() }}
</div>
@endsection