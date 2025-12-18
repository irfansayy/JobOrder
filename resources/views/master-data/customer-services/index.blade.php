@extends('layouts.app')

@section('title', 'Customer Services')
@section('subtitle', 'Manage customer service data')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-slate-600">Total: <span class="font-bold text-slate-800">{{ $customerServices->total() }}</span> customer services</p>
    </div>
    <a href="{{ route('master-data.customer-services.create') }}" 
       class="w-full sm:w-auto relative inline-flex items-center justify-center px-6 py-3 text-white font-bold rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
        <span class="relative"><i class="fas fa-plus-circle mr-2"></i>Add New Customer Service</span>
    </a>
</div>

<div class="overflow-x-auto rounded-xl shadow-md bg-white border border-slate-200">
    <table class="min-w-full">
        <thead class="gradient-soft-slate text-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Name</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Code</th>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase">Description</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase">Status</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($customerServices as $cs)
            <tr class="hover:bg-slate-50 transition duration-150">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="font-bold text-slate-800">{{ $cs->name }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-teal-50 text-teal-700 rounded-full text-sm font-semibold border border-teal-200">
                        {{ $cs->code }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-slate-700">
                    {{ $cs->description ?? '-' }}
                </td>
                <td class="px-6 py-4 text-center">
                    @if($cs->is_active)
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
                        <a href="{{ route('master-data.customer-services.edit', $cs) }}" 
                           class="text-emerald-600 hover:text-emerald-800 transition" title="Edit">
                            <i class="fas fa-edit text-lg"></i>
                        </a>
                        <form action="{{ route('master-data.customer-services.destroy', $cs) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this customer service?');" class="inline">
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
                <td colspan="5" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-inbox text-6xl text-slate-300 mb-4"></i>
                        <p class="text-slate-500 text-lg font-semibold">No customer services found</p>
                        <a href="{{ route('master-data.customer-services.create') }}" class="mt-4 text-teal-600 hover:text-teal-800 font-semibold transition">
                            <i class="fas fa-plus-circle mr-2"></i>Create your first customer service
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $customerServices->links() }}
</div>
@endsection