<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Brand;
use App\Models\CustomerService;
use App\Models\ProductionStatus;
use App\Models\OrderType;
use App\Models\OrderPriority;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@joborder.com',
            'password' => Hash::make('password'),
        ]);

        // Create Brands
        $brands = [
            ['name' => 'DASH ID', 'code' => 'DASH_ID', 'description' => 'Brand DASH ID'],
            ['name' => 'FLICK', 'code' => 'FLICK', 'description' => 'Brand FLICK'],
            ['name' => 'Baseline', 'code' => 'BASELINE', 'description' => 'Brand Baseline'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Create Customer Services
        $customerServices = [
            ['name' => 'Customer Service 1', 'email' => 'cs1@joborder.com', 'phone' => '081234567890'],
            ['name' => 'Customer Service 2', 'email' => 'cs2@joborder.com', 'phone' => '081234567891'],
            ['name' => 'Customer Service 3', 'email' => 'cs3@joborder.com', 'phone' => '081234567892'],
        ];

        foreach ($customerServices as $cs) {
            CustomerService::create($cs);
        }

        // Create Production Statuses
        $statuses = [
            ['name' => 'Pending', 'code' => 'PENDING', 'order_sequence' => 1, 'color' => 'yellow'],
            ['name' => 'Cutting', 'code' => 'CUTTING', 'order_sequence' => 2, 'color' => 'blue'],
            ['name' => 'Sewing', 'code' => 'SEWING', 'order_sequence' => 3, 'color' => 'purple'],
            ['name' => 'Quality Check', 'code' => 'QC', 'order_sequence' => 4, 'color' => 'orange'],
            ['name' => 'Packing', 'code' => 'PACKING', 'order_sequence' => 5, 'color' => 'indigo'],
            ['name' => 'Ready to Ship', 'code' => 'READY', 'order_sequence' => 6, 'color' => 'green'],
            ['name' => 'Shipped', 'code' => 'SHIPPED', 'order_sequence' => 7, 'color' => 'teal'],
            ['name' => 'Completed', 'code' => 'COMPLETED', 'order_sequence' => 8, 'color' => 'gray'],
        ];

        foreach ($statuses as $status) {
            ProductionStatus::create($status);
        }

        // Create Order Types
        $orderTypes = [
            ['name' => 'Satuan', 'code' => 'SATUAN'],
            ['name' => 'Retail', 'code' => 'RETAIL'],
            ['name' => 'Team', 'code' => 'TEAM'],
            ['name' => 'Makloon Print Press', 'code' => 'MAKLOON_PRINT'],
            ['name' => 'Makloon Jahit', 'code' => 'MAKLOON_JAHIT'],
        ];

        foreach ($orderTypes as $type) {
            OrderType::create($type);
        }

        // Create Order Priorities
        $priorities = [
            ['name' => 'Normal', 'code' => 'NORMAL', 'color' => 'blue'],
            ['name' => 'High', 'code' => 'HIGH', 'color' => 'red'],
        ];

        foreach ($priorities as $priority) {
            OrderPriority::create($priority);
        }
    }
}