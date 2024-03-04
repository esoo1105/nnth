<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhsachlophocsTable extends Migration
{
    public function up()
    {
        Schema::create('danhsachlophocs', function (Blueprint $table) {
            $table->id();
            $table->string('co_so', 50);
            $table->string('lop_hoc', 50);
            $table->foreignId('khoahoc_id')->constrained('khoahocs');
            $table->string('ma_sinh_vien', 50);
            $table->string('ho_dem', 50);
            $table->string('ten', 50);
            $table->string('ngay_sinh', 50);
            $table->string('gioi_tinh', 10);
            $table->string('lop_danh_nghia', 50);
            $table->string('so_dien_thoai', 50);
            $table->string('email', 100);
            $table->text('ghi_chu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('danhsachlophocs');
    }
}
