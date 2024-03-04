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
        Schema::create('ketquas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sinhvien_id'); // Khóa ngoại của bảng sinhviens
            $table->foreign('sinhvien_id')->references('id')->on('sinhviens')->onDelete('cascade');
            $table->decimal('diem_tin_hoc', 5, 2);
            $table->string('bang_tin_hoc');
            $table->decimal('diem_anh_van', 5, 2);
            $table->string('bang_anh_van');
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->string('email')->nullable(); // Thêm cột 'email'
            $table->string('mssv')->nullable(); // Thêm cột 'mssv'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ketquas', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi xóa bảng
            $table->dropForeign(['sinhvien_id', 'email', 'mssv']);
        });

        Schema::dropIfExists('ketquas');
    }
};
