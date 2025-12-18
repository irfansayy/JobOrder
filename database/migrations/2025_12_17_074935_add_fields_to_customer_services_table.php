<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCustomerServicesTable extends Migration
{
    public function up()
    {
        Schema::table('customer_services', function (Blueprint $table) {
            $table->string('name');
            $table->string('code')->unique(); // kode unik
            $table->text('description')->nullable();
            $table->string('email')->nullable(); // opsional, jika nanti butuh
            $table->string('phone')->nullable(); // opsional
            $table->boolean('is_active')->default(true);
            
            // Jika belum ada, tambahkan timestamps (biasanya sudah ada)
            if (!Schema::hasColumn('customer_services', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('customer_services', function (Blueprint $table) {
            $table->dropColumn(['name', 'code', 'description', 'email', 'phone', 'is_active']);
        });
    }
}