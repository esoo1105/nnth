<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->string('mssv')->unique();
            $table->string('ho_ten');
            $table->date('ngay_sinh');
            $table->timestamp('thoi_gian_dang_ky')->default(now());
            $table->text('so_tien_da_dong')->default(0);
            $table->string('lop_danh_nghia');
            $table->string('noi_sinh');
            $table->string('so_dien_thoai');
            $table->string('email');
            $table->unsignedBigInteger('khoahoc_id'); // Khóa ngoại của bảng khoahocs
            $table->foreign('khoahoc_id')->references('id')->on('khoahocs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinhviens');
    }
};
