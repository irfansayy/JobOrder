@extends('layouts.app')

@section('title', 'Job Order Detail')
@section('subtitle', 'View job order details')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header Actions -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <a href="{{ route('job-orders.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to List
        </a>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('job-orders.edit', $jobOrder) }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-lg hover:from-teal-600 hover:to-emerald-600 transition duration-200 shadow-md">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <form action="{{ route('job-orders.destroy', $jobOrder) }}" method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus job order ini?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-rose-500 to-pink-500 text-white font-semibold rounded-lg hover:from-rose-600 hover:to-pink-600 transition duration-200 shadow-md">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Job Order Details Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-200">
        <!-- Header -->
        <div class="relative overflow-hidden px-8 py-6">
            <div class="absolute inset-0 gradient-soft-slate opacity-90"></div>
            <div class="relative">
                <h2 class="text-2xl font-bold text-white drop-shadow-lg">{{ $jobOrder->order_code }}</h2>
                <p class="text-white text-opacity-80 mt-1">Created on {{ $jobOrder->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 sm:p-8 space-y-6">
            <!-- Row 1: Order Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Order Date</label>
                    <p class="mt-1 text-lg text-slate-900">{{ $jobOrder->order_date->format('d M Y') }}</p>
                </div>
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Deadline</label>
                    <p class="mt-1 text-lg">
                        @php
                            $isOverdue = $jobOrder->deadline->isPast();
                            $isToday = $jobOrder->deadline->isToday();
                        @endphp
                        <span class="font-semibold {{ $isOverdue ? 'text-rose-600' : ($isToday ? 'text-amber-600' : 'text-slate-900') }}">
                            {{ $jobOrder->deadline->format('d M Y') }}
                            @if($isOverdue)
                                <span class="ml-2 px-2 py-1 bg-rose-100 text-rose-800 text-xs rounded-full border border-rose-200">OVERDUE</span>
                            @elseif($isToday)
                                <span class="ml-2 px-2 py-1 bg-amber-100 text-amber-800 text-xs rounded-full border border-amber-200">TODAY</span>
                            @endif
                        </span>
                    </p>
                </div>
            </div>

            <hr class="border-slate-200">

            <!-- Row 2: Customer & Brand -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Customer Service</label>
                    <p class="mt-1 text-lg text-slate-900">{{ $jobOrder->customerService->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Brand</label>
                    <p class="mt-1">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-semibold border border-indigo-200">
                            {{ $jobOrder->brand->name ?? '-' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Row 3: Client & Quantity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Client Name</label>
                    <p class="mt-1 text-lg text-slate-900">{{ $jobOrder->client->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Quantity</label>
                    <p class="mt-1 text-2xl font-bold text-slate-900">{{ number_format($jobOrder->qty) }} pcs</p>
                </div>
            </div>

            <hr class="border-slate-200">

            <!-- Row 4: Order Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Order Type</label>
                    <p class="mt-1 text-lg text-slate-900">{{ $jobOrder->orderType->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Product</label>
                    <p class="mt-1 text-lg text-slate-900">{{ $jobOrder->product->name ?? '-' }}</p>
                    @if($jobOrder->product)
                        <p class="text-sm text-slate-600">Rp. {{ number_format($jobOrder->product->price, 0, ',', '.') }}</p>
                    @endif
                </div>
            </div>

            <!-- Row 5: Status & Priority -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Production Status</label>
                    <p class="mt-1">
                        @if($jobOrder->productionStatus)
                            <span class="px-3 py-1 bg-{{ $jobOrder->productionStatus->color ?? 'gray' }}-50 text-{{ $jobOrder->productionStatus->color ?? 'gray' }}-700 border border-{{ $jobOrder->productionStatus->color ?? 'gray' }}-200 rounded-full text-sm font-semibold">
                                {{ $jobOrder->productionStatus->name }}
                            </span>
                        @else
                            <span class="text-slate-500">-</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">Priority</label>
                    <p class="mt-1">
                        @if($jobOrder->orderPriority)
                            <span class="px-3 py-1 bg-{{ $jobOrder->orderPriority->color ?? 'gray' }}-50 text-{{ $jobOrder->orderPriority->color ?? 'gray' }}-700 border border-{{ $jobOrder->orderPriority->color ?? 'gray' }}-200 rounded-full text-sm font-semibold">
                                <i class="fas fa-{{ $jobOrder->orderPriority->code === 'HIGH' ? 'exclamation-circle' : 'check-circle' }} mr-1"></i>
                                {{ $jobOrder->orderPriority->name }}
                            </span>
                        @else
                            <span class="text-slate-500">-</span>
                        @endif
                    </p>
                </div>
            </div>

            <hr class="border-slate-200">

            <!-- Row 6: PO Files -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">PO File</label>
                    <p class="mt-1">
                        @if($jobOrder->po_file)
                            <a href="{{ Storage::url($jobOrder->po_file) }}" target="_blank"
                               class="inline-flex items-center text-teal-600 hover:text-teal-800 font-semibold transition">
                                <i class="fas fa-file-download mr-2"></i>Download PO File
                            </a>
                        @else
                            <span class="text-slate-500">-</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="text-sm font-bold text-slate-600 uppercase">PO Link</label>
                    <p class="mt-1">
                        @if($jobOrder->po_link)
                            <a href="{{ $jobOrder->po_link }}" target="_blank"
                               class="inline-flex items-center text-teal-600 hover:text-teal-800 font-semibold break-all transition">
                                <i class="fas fa-external-link-alt mr-2"></i>{{ Str::limit($jobOrder->po_link, 40) }}
                            </a>
                        @else
                            <span class="text-slate-500">-</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Row 7: Notes -->
            @if($jobOrder->notes)
            <div>
                <label class="text-sm font-bold text-slate-600 uppercase">Notes</label>
                <div class="mt-2 p-4 bg-slate-50 rounded-lg border border-slate-200">
                    <p class="text-slate-900 whitespace-pre-line">{{ $jobOrder->notes }}</p>
                </div>
            </div>
            @endif

            <hr class="border-slate-200">

            <!-- Row 8: Timestamps -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-600">
                <div>
                    <label class="font-bold text-slate-600 uppercase">Created At</label>
                    <p class="mt-1">{{ $jobOrder->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="font-bold text-slate-600 uppercase">Last Updated</label>
                    <p class="mt-1">{{ $jobOrder->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection