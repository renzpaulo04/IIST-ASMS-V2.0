<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('course_code');
            $table->string('coriculum_year');
            $table->string('subject_code');
            $table->string('subject_title');
            $table->integer('units');
            $table->integer('lecHours');
            $table->integer('labHours')->nullable();
            $table->string('year');
            $table->string('semester',3);
            $table->string('role');
            $table->string('created_by')->nullable();
            $table->string('changed_by')->nullable();
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
        Schema::dropIfExists('subjects');
    }
}
