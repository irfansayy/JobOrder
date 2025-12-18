<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name');
            $table->string('code', 50)->unique();
            $table->decimal('price', 10, 2); // harga dengan 2 desimal
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);

            // Jika belum ada, tambahkan timestamps (biasanya sudah ada)
            if (!Schema::hasColumn('products', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name', 'code', 'price', 'description', 'is_active']);
        });
    }
}