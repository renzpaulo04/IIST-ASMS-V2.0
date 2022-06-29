<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_forms', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('room');
            $table->string('teacher');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('noStudent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_forms');
    }
}
