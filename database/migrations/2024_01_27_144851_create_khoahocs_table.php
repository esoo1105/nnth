<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhoahocsTable extends Migration
{
    public function up()
    {
        Schema::create('khoahocs', function (Blueprint $table) {
            $table->id();
            $table->string('dot_hoc', 50);
            $table->string('ma_khoahoc', 50);
            $table->string('ten_khoahoc', 100);
            $table->string('nguoi_dang_bai', 50);
            $table->date('ngay_khai_giang');
            $table->string('dia_diem_dang_ky', 100);
            $table->string('hinh_anh', 255);
            $table->foreignId('loaikhoahoc_id')->constrained('loaikhoahocs');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('khoahocs');
    }
}
