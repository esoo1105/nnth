<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuyensTable extends Migration
{
    public function up()
    {
        Schema::create('quyens', function (Blueprint $table) {
            $table->id();
            $table->string('ten_quyen', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quyens');
    }
}
