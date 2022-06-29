<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('section');
            $table->string('idNumber');
            $table->string('lastName');
            $table->string('firstName');
            $table->string('startSchool');
            $table->string('teacher');
            $table->string('semester');
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
        Schema::dropIfExists('subject_attendances');
    }
}
