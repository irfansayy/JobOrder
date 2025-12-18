<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->string('order_code')->unique();
            $table->foreignId('customer_service_id')->constrained('customer_services')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->integer('qty');
            $table->foreignId('order_type_id')->constrained('order_types')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('production_status_id')->constrained('production_statuses')->onDelete('cascade');
            $table->foreignId('order_priority_id')->constrained('order_priorities')->onDelete('cascade');
            $table->date('deadline');
            $table->string('po_file')->nullable();
            $table->text('po_link')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_orders');
    }
};