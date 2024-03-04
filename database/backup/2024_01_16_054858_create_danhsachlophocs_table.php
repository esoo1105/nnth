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
        Schema::create('danhsachlophocs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_sinh_vien');
            $table->string('ho_dem');
            $table->string('ten');
            $table->string('lop_danh_nghia');
            $table->string('gioi_tinh');
            $table->date('ngay_sinh');
            $table->string('so_dien_thoai');
            $table->string('email');
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhsachlophocs');
    }
};
