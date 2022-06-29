<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generates', function (Blueprint $table) {
            $table->id();
            $table->string('course');
            $table->string('year');
            $table->string('section');
            $table->string('semester');
            $table->string('subject');
            $table->string('teacher');
            $table->string('room');
            $table->string('weekday');
            $table->string('startTime');
            $table->string('endTime');
            $table->integer('units')->nullable();
            $table->string('created_by')->nullable();
            $table->string('changed_by')->nullable();
            $table->integer('difference');
            $table->string('startSchool');
            $table->string('endSchool');
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
        Schema::dropIfExists('generates');
    }
}
