<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_priorities', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('code', 50)->unique()->after('name');
            $table->string('color', 20)->default('gray')->after('code');
            $table->boolean('is_active')->default(true)->after('color');
        });
    }

    public function down(): void
    {
        Schema::table('order_priorities', function (Blueprint $table) {
            $table->dropColumn(['name', 'code', 'color', 'is_active']);
        });
    }
};