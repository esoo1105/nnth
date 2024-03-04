<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaikhoahocsTable extends Migration
{
    public function up()
    {
        Schema::create('loaikhoahocs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_loaikhoahoc', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loaikhoahocs');
    }
}
