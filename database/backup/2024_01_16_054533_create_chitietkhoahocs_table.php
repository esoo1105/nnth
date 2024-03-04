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
        Schema::create('chitietkhoahocs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('khoahoc_id'); // Khóa ngoại của bảng khoahocs
            $table->foreign('khoahoc_id')->references('id')->on('khoahocs')->onDelete('cascade');

            $table->string('thoi_gian_hoc'); // 2h, 3h, 4h, ...

            $table->integer('so_tiet_hoc');
            $table->string('dia_diem_hoc');
            $table->string('thu_hoc');

            $table->unsignedBigInteger('giangvien_id'); // Khóa ngoại của bảng users với quyền giangvien
            $table->foreign('giangvien_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('hoc_phi'); // Sử dụng decimal cho giá trị tiền để tránh lỗi làm tròn
            $table->text('mo_ta_khoa_hoc');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietkhoahocs');
    }
};
