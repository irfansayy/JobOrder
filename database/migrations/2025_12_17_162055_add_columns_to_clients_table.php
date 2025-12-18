<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('email')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->boolean('is_active')->default(true)->after('address');
            
            $table->index('name');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active']);
            $table->dropColumn(['name', 'email', 'phone', 'address', 'is_active']);
        });
    }
};