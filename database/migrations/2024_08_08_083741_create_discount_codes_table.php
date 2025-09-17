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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique()->comment('Mã giảm giá, duy nhất');
            $table->bigInteger('discount_amount')->comment('Số tiền giảm giá');
            $table->date('valid_from')->nullable()->comment('Ngày bắt đầu hiệu lực');
            $table->date('valid_until')->nullable()->comment('Ngày kết thúc hiệu lực');
            $table->integer('usage_limit')->nullable()->comment('Giới hạn số lần sử dụng');
            $table->integer('usage_count')->default(0)->comment('Số lần đã sử dụng');
            $table->boolean('active')->default(false)->comment('Trạng thái hoạt động của mã');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
