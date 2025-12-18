@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Overview of Job Orders and Production Progress')

@section('content')
<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total PO Card -->
    <div class="relative overflow-hidden bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-300 border border-slate-200 group">
        <div class="absolute inset-0 gradient-soft-slate opacity-90 group-hover:opacity-95 transition-opacity"></div>
        <div class="relative flex items-center justify-between text-white">
            <div>
                <p class="text-white text-opacity-80 text-sm font-semibold mb-1">Total PO</p>
                <p class="text-4xl font-bold drop-shadow-lg">{{ $totalPO }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                <i class="fas fa-clipboard-list text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- DASH ID Card -->
    <div class="relative overflow-hidden bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-300 border border-teal-200 group">
        <div class="absolute inset-0 gradient-soft-teal opacity-90 group-hover:opacity-95 transition-opacity"></div>
        <div class="relative flex items-center justify-between text-white">
            <div>
                <p class="text-white text-opacity-80 text-sm font-semibold mb-1">PO DASH ID</p>
                <p class="text-4xl font-bold drop-shadow-lg">{{ $totalPODashID }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                <i class="fas fa-tag text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- FLICK Card -->
    <div class="relative overflow-hidden bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-300 border border-indigo-200 group">
        <div class="absolute inset-0 gradient-soft-indigo opacity-90 group-hover:opacity-95 transition-opacity"></div>
        <div class="relative flex items-center justify-between text-white">
            <div>
                <p class="text-white text-opacity-80 text-sm font-semibold mb-1">PO FLICK</p>
                <p class="text-4xl font-bold drop-shadow-lg">{{ $totalPOFlick }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                <i class="fas fa-fire text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Baseline Card -->
    <div class="relative overflow-hidden bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-300 border border-emerald-200 group">
        <div class="absolute inset-0 gradient-soft-green opacity-90 group-hover:opacity-95 transition-opacity"></div>
        <div class="relative flex items-center justify-between text-white">
            <div>
                <p class="text-white text-opacity-80 text-sm font-semibold mb-1">PO Baseline</p>
                <p class="text-4xl font-bold drop-shadow-lg">{{ $totalPOBaseline }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                <i class="fas fa-layer-group text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="relative overflow-hidden bg-white rounded-xl p-6 mb-8 shadow-sm border border-slate-200">
    <div class="absolute top-0 right-0 w-48 h-48 gradient-soft-teal opacity-5 blur-3xl rounded-full"></div>
    <div class="relative flex flex-wrap items-center gap-4">
        <h3 class="text-lg font-bold text-slate-800 flex items-center">
            <i class="fas fa-filter mr-2 text-teal-600"></i>Filters:
        </h3>
        
        <a href="{{ route('dashboard', ['filter' => 'all']) }}" 
           class="relative overflow-hidden px-5 py-2.5 rounded-lg font-semibold transition-all duration-300 {{ $filter === 'all' ? 'text-white shadow-md' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
            @if($filter === 'all')
                <span class="absolute inset-0 gradient-soft-teal"></span>
            @endif
            <span class="relative flex items-center">
                <i class="fas fa-list mr-2"></i>All Orders
            </span>
        </a>
        
        <a href="{{ route('dashboard', ['filter' => 'deadline_today']) }}" 
           class="relative overflow-hidden px-5 py-2.5 rounded-lg font-semibold transition-all duration-300 {{ $filter === 'deadline_today' ? 'text-white shadow-md' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
            @if($filter === 'deadline_today')
                <span class="absolute inset-0 bg-gradient-to-r from-rose-500 to-pink-500"></span>
            @endif
            <span class="relative flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>Deadline Today ({{ $deadlineToday }})
            </span>
        </a>
    </div>
</div>

<!-- QTY Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="relative overflow-hidden bg-white border-l-4 border-slate-500 rounded-lg shadow-sm p-5 hover:shadow-md transition-all duration-300 group">
        <div class="absolute top-0 right-0 w-24 h-24 gradient-soft-slate opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-semibold mb-1">Total QTY All</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-slate-700 to-slate-900 bg-clip-text text-transparent">
                    {{ number_format($totalQtyAll) }}
                </p>
            </div>
            <i class="fas fa-boxes text-4xl text-slate-300 group-hover:text-slate-400 transition-colors"></i>
        </div>
    </div>

    <div class="relative overflow-hidden bg-white border-l-4 border-teal-500 rounded-lg shadow-sm p-5 hover:shadow-md transition-all duration-300 group">
        <div class="absolute top-0 right-0 w-24 h-24 gradient-soft-teal opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-semibold mb-1">QTY DASH ID</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-emerald-600 bg-clip-text text-transparent">
                    {{ number_format($totalQtyDashID) }}
                </p>
            </div>
            <i class="fas fa-box text-4xl text-teal-200 group-hover:text-teal-300 transition-colors"></i>
        </div>
    </div>

    <div class="relative overflow-hidden bg-white border-l-4 border-indigo-500 rounded-lg shadow-sm p-5 hover:shadow-md transition-all duration-300 group">
        <div class="absolute top-0 right-0 w-24 h-24 gradient-soft-indigo opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-semibold mb-1">QTY FLICK</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    {{ number_format($totalQtyFlick) }}
                </p>
            </div>
            <i class="fas fa-box text-4xl text-indigo-200 group-hover:text-indigo-300 transition-colors"></i>
        </div>
    </div>

    <div class="relative overflow-hidden bg-white border-l-4 border-emerald-500 rounded-lg shadow-sm p-5 hover:shadow-md transition-all duration-300 group">
        <div class="absolute top-0 right-0 w-24 h-24 gradient-soft-green opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-semibold mb-1">QTY Baseline</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                    {{ number_format($totalQtyBaseline) }}
                </p>
            </div>
            <i class="fas fa-box text-4xl text-emerald-200 group-hover:text-emerald-300 transition-colors"></i>
        </div>
    </div>
</div>

<!-- Production Progress -->
<div class="relative overflow-hidden bg-white rounded-xl shadow-sm p-6 border border-slate-200">
    <div class="absolute top-0 left-0 w-64 h-64 gradient-soft-teal opacity-5 blur-3xl rounded-full"></div>
    
    <div class="relative">
        <h3 class="text-2xl font-bold bg-gradient-to-r from-slate-700 to-slate-900 bg-clip-text text-transparent mb-6 flex items-center">
            <i class="fas fa-chart-line mr-3 text-teal-600"></i>Production Progress
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($productionStatuses as $status)
            <div class="relative overflow-hidden bg-gradient-to-br from-{{ $status->color }}-50 via-white to-{{ $status->color }}-50 border-2 border-{{ $status->color }}-200 rounded-xl p-6 transform hover:scale-105 hover:shadow-lg transition-all duration-300 group">
                <!-- Subtle gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-{{ $status->color }}-100 to-transparent opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-lg text-{{ $status->color }}-700">{{ $status->name }}</h4>
                        <span class="bg-{{ $status->color }}-100 text-{{ $status->color }}-700 text-xs font-bold px-3 py-1 rounded-full border border-{{ $status->color }}-300 shadow-sm">
                            #{{ $status->order_sequence }}
                        </span>
                    </div>
                    <div class="text-center">
                        <p class="text-5xl font-bold bg-gradient-to-br from-{{ $status->color }}-600 to-{{ $status->color }}-800 bg-clip-text text-transparent mb-2 drop-shadow-sm">
                            {{ $status->job_orders_count }}
                        </p>
                        <p class="text-sm text-{{ $status->color }}-600 font-semibold uppercase tracking-wide">Orders</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8">
    <a href="{{ route('job-orders.create') }}" 
       class="relative inline-flex items-center px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg overflow-hidden group">
        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90 transition-opacity"></span>
        <span class="relative flex items-center">
            <i class="fas fa-plus-circle mr-2"></i>Create New Job Order
        </span>
    </a>
</div>

<!-- <style>
    /* Additional gradient text effects */
    .bg-clip-text {
        -webkit-background-clip: text;
        background-clip: text;
    }
    
    /* Smooth hover transitions for cards */
    [class*="group"]:hover {
        transform: translateY(-2px);
    }
</style> -->
@endsection