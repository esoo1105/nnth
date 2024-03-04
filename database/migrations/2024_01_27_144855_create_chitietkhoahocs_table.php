<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietkhoahocsTable extends Migration
{
    public function up()
    {
        Schema::create('chitietkhoahocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('khoahoc_id')->constrained('khoahocs')->onDelete('cascade');
            $table->date('thoi_gian_bat_dau');
            $table->date('thoi_gian_ket_thuc');
            $table->string('thoi_gian_hoc', 50);
            $table->string('dia_diem_hoc', 100);
            $table->string('thu_hoc', 50);
            $table->string('so_tiet_hoc', 50);
            $table->text('hoc_phi');
            $table->foreignId('giangvien_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chitietkhoahocs');
    }
}
