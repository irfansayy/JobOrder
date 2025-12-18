@extends('layouts.app')

@section('title', 'Production Statuses')
@section('subtitle', 'Manage production status data')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-slate-600">Total: <span class="font-bold text-slate-800">{{ $productionStatuses->total() }}</span> statuses</p>
    </div>
    <a href="{{ route('master-data.production-statuses.create') }}" 
       class="w-full sm:w-auto relative inline-flex items-center justify-center px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
        <span class="relative"><i class="fas fa-plus-circle mr-2"></i>Add New Status</span>
    </a>
</div>

<div class="overflow-x-auto rounded-xl shadow-md bg-white border border-slate-200">
    <table class="min-w-full">
        <thead class="gradient-soft-slate text-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Sequence</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Name</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Code</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase">Color</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase">Status</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($productionStatuses as $status)
            <tr class="hover:bg-slate-50 transition duration-150">
                <td class="px-6 py-4 text-center">
                    <span class="relative inline-flex items-center justify-center w-10 h-10 rounded-full text-white font-bold text-lg shadow-md overflow-hidden">
                        <span class="absolute inset-0 gradient-soft-teal"></span>
                        <span class="relative">{{ $status->order_sequence }}</span>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="font-bold text-slate-800">{{ $status->name }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-teal-50 text-teal-700 rounded-full text-sm font-semibold border border-teal-200">
                        {{ $status->code }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-{{ $status->color }}-500 border-2 border-{{ $status->color }}-600 shadow-md"></div>
                        <span class="px-3 py-1 bg-{{ $status->color }}-50 text-{{ $status->color }}-700 rounded-full text-xs font-semibold capitalize border border-{{ $status->color }}-200">
                            {{ $status->color }}
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4 text-center">
                    @if($status->is_active)
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold border border-emerald-200">
                            <i class="fas fa-check-circle mr-1"></i>Active
                        </span>
                    @else
                        <span class="px-3 py-1 bg-rose-50 text-rose-700 rounded-full text-xs font-semibold border border-rose-200">
                            <i class="fas fa-times-circle mr-1"></i>Inactive
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <a href="{{ route('master-data.production-statuses.edit', $status) }}" 
                           class="text-emerald-600 hover:text-emerald-800 transition" title="Edit">
                            <i class="fas fa-edit text-lg"></i>
                        </a>
                        <form action="{{ route('master-data.production-statuses.destroy', $status) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this status?');" class="inline">
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
                <td colspan="6" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-inbox text-6xl text-slate-300 mb-4"></i>
                        <p class="text-slate-500 text-lg font-semibold">No production statuses found</p>
                        <a href="{{ route('master-data.production-statuses.create') }}" class="mt-4 text-teal-600 hover:text-teal-800 font-semibold transition">
                            <i class="fas fa-plus-circle mr-2"></i>Create your first status
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $productionStatuses->links() }}
</div>
@endsection