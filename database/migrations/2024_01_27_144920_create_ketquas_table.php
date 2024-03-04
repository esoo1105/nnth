<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKetquasTable extends Migration
{
    public function up()
    {
        Schema::create('ketquas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sinhvien_id')->constrained('sinhviens');
            $table->string('diem_tin_hoc', 5);
            $table->string('bang_tin_hoc', 50);
            $table->string('diem_anh_van', 5);
            $table->string('bang_anh_van', 50);
            $table->string('otp', 10);
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ketquas');
    }
}
