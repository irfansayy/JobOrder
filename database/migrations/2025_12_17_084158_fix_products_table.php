<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'code')) {
                $table->string('name');
                $table->string('code', 50)->unique();
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(true);
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name', 'code', 'price', 'description', 'is_active']);
        });
    }
};
