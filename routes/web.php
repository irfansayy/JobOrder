<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionStatusController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\OrderPriorityController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data Routes
    Route::prefix('master-data')->name('master-data.')->group(function () {
        Route::resource('brands', BrandController::class);
        Route::resource('customer-services', CustomerServiceController::class);
        Route::resource('products', ProductController::class);
        Route::resource('production-statuses', ProductionStatusController::class);
        Route::resource('order-types', OrderTypeController::class);
        Route::resource('order-priorities', OrderPriorityController::class);
    });

    // Job Orders
    Route::resource('job-orders', JobOrderController::class);
});