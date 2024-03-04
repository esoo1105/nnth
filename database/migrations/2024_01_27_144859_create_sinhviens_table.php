<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinhviensTable extends Migration
{
    public function up()
    {
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_sinh_vien', 50);
            $table->string('ho_dem', 50);
            $table->string('ten', 50);
            $table->string('ngay_sinh', 50);
            $table->string('gioi_tinh', 10);
            $table->string('thoi_gian_dang_ky', 50);
            $table->text('so_tien_da_dong');
            $table->text('so_tien_con_lai');
            $table->string('lop_danh_nghia', 50);
            $table->string('so_dien_thoai', 50);
            $table->string('email', 100);
            $table->text('ghi_chu');
            $table->foreignId('khoahoc_id')->constrained('khoahocs');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sinhviens');
    }
}
