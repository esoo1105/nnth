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
        Schema::create('khoahocs', function (Blueprint $table) {
            $table->id(); // Mã khóa học (khóa chính)
            $table->string('ma_khoahoc')->unique();
            $table->string('ten_khoahoc');
            $table->string('nguoi_dang_bai');
            $table->date('ngay_khai_giang');
            $table->string('dia_diem_dang_ky');
            $table->string('hinh_anh')->nullable(); // Hình ảnh có thể là null
            $table->unsignedBigInteger('loaikhoahoc_id');
            $table->foreign('loaikhoahoc_id')->references('id')->on('loaikhoahocs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khoahocs');
    }
};
