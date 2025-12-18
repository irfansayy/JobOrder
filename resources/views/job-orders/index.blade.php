@extends('layouts.app')

@section('title', 'Job Orders')
@section('subtitle', 'Manage all job orders')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-slate-600">Total: <span class="font-bold text-slate-800">{{ $jobOrders->total() }}</span> job orders</p>
    </div>
    <a href="{{ route('job-orders.create') }}" 
       class="w-full sm:w-auto relative inline-flex items-center justify-center px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
        <span class="relative"><i class="fas fa-plus-circle mr-2"></i>Create New Job Order</span>
    </a>
</div>

<!-- Table -->
<div class="overflow-x-auto rounded-xl shadow-md bg-white border border-slate-200">
    <table class="min-w-full">
        <thead class="gradient-soft-slate text-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Order Code</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Date</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">CS</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Brand</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Client</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Product</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase">QTY</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Status</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Priority</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Deadline</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($jobOrders as $order)
            <tr class="hover:bg-slate-50 transition duration-150">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="font-bold text-teal-600">{{ $order->order_code }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                    {{ $order->order_date->format('d M Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                    {{ $order->customerService->name ?? '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-semibold border border-indigo-200">
                        {{ $order->brand->name ?? '-' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                    {{ $order->client->name ?? '-' }}
                </td>
                <td class="px-6 py-4 text-sm text-slate-700">
                    {{ $order->product->name ?? '-' }}
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="font-bold text-slate-800">{{ number_format($order->qty) }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($order->productionStatus)
                        <span class="px-3 py-1 bg-{{ $order->productionStatus->color ?? 'gray' }}-50 text-{{ $order->productionStatus->color ?? 'gray' }}-700 border border-{{ $order->productionStatus->color ?? 'gray' }}-200 rounded-full text-xs font-semibold">
                            {{ $order->productionStatus->name }}
                        </span>
                    @else
                        <span class="px-3 py-1 bg-slate-50 text-slate-700 rounded-full text-xs font-semibold">-</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($order->orderPriority)
                        <span class="px-3 py-1 bg-{{ $order->orderPriority->color ?? 'gray' }}-50 text-{{ $order->orderPriority->color ?? 'gray' }}-700 border border-{{ $order->orderPriority->color ?? 'gray' }}-200 rounded-full text-xs font-semibold">
                            <i class="fas fa-{{ $order->orderPriority->code === 'HIGH' ? 'exclamation-circle' : 'check-circle' }} mr-1"></i>
                            {{ $order->orderPriority->name }}
                        </span>
                    @else
                        <span class="px-3 py-1 bg-slate-50 text-slate-700 rounded-full text-xs font-semibold">-</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    @php
                        $isOverdue = $order->deadline->isPast();
                        $isToday = $order->deadline->isToday();
                    @endphp
                    <span class="font-semibold {{ $isOverdue ? 'text-rose-600' : ($isToday ? 'text-amber-600' : 'text-slate-700') }}">
                        {{ $order->deadline->format('d M Y') }}
                        @if($isOverdue)
                            <i class="fas fa-exclamation-triangle ml-1"></i>
                        @elseif($isToday)
                            <i class="fas fa-clock ml-1"></i>
                        @endif
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <a href="{{ route('job-orders.show', $order) }}" 
                           class="text-teal-600 hover:text-teal-800 transition" title="View">
                            <i class="fas fa-eye text-lg"></i>
                        </a>
                        <a href="{{ route('job-orders.edit', $order) }}" 
                           class="text-emerald-600 hover:text-emerald-800 transition" title="Edit">
                            <i class="fas fa-edit text-lg"></i>
                        </a>
                        <form action="{{ route('job-orders.destroy', $order) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus job order ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-800 transition" title="Delete">
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-inbox text-6xl text-slate-300 mb-4"></i>
                        <p class="text-slate-500 text-lg font-semibold">Belum ada job order</p>
                        <a href="{{ route('job-orders.create') }}" class="mt-4 text-teal-600 hover:text-teal-800 font-semibold">
                            <i class="fas fa-plus-circle mr-2"></i>Buat job order pertama Anda
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($jobOrders->hasPages())
<div class="mt-6">
    {{ $jobOrders->links() }}
</div>
@endif
@endsection