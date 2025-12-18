<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_types', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('code', 50)->unique()->after('name');
            $table->boolean('is_active')->default(true)->after('code');
        });
    }

    public function down(): void
    {
        Schema::table('order_types', function (Blueprint $table) {
            $table->dropColumn(['name', 'code', 'is_active']);
        });
    }
};