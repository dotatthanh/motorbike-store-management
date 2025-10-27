<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_order_id');
            $table->unsignedBigInteger('motorcycle_id');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('total_money');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_items');
    }
};
