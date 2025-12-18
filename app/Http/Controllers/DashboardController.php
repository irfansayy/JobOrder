<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\Brand;
use App\Models\ProductionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameter
        $filter = $request->get('filter', 'all');

        // Total PO
        $totalPO = JobOrder::count();

        // Total PO by Brand
        $brands = Brand::withCount('jobOrders')->get();
        $totalPODashID = $brands->where('code', 'DASH_ID')->first()->job_orders_count ?? 0;
        $totalPOFlick = $brands->where('code', 'FLICK')->first()->job_orders_count ?? 0;
        $totalPOBaseline = $brands->where('code', 'BASELINE')->first()->job_orders_count ?? 0;

        // Production Progress with filters
        $query = JobOrder::with(['productionStatus', 'brand']);

        if ($filter === 'deadline_today') {
            $query->deadlineToday();
        }

        $jobOrders = $query->get();

        // Group by production status
        $productionStatuses = ProductionStatus::orderBy('order_sequence')
            ->withCount(['jobOrders' => function($q) use ($filter) {
                if ($filter === 'deadline_today') {
                    $q->deadlineToday();
                }
            }])
            ->get();

        // Total QTY calculations
        $totalQtyAll = $jobOrders->sum('qty');
        $totalQtyDashID = $jobOrders->where('brand.code', 'DASH_ID')->sum('qty');
        $totalQtyFlick = $jobOrders->where('brand.code', 'FLICK')->sum('qty');
        $totalQtyBaseline = $jobOrders->where('brand.code', 'BASELINE')->sum('qty');

        // Deadline Today Count
        $deadlineToday = JobOrder::deadlineToday()->count();

        return view('dashboard', compact(
            'totalPO',
            'totalPODashID',
            'totalPOFlick',
            'totalPOBaseline',
            'productionStatuses',
            'totalQtyAll',
            'totalQtyDashID',
            'totalQtyFlick',
            'totalQtyBaseline',
            'deadlineToday',
            'filter'
        ));
    }
}