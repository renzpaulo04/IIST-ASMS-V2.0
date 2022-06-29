<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultys', function (Blueprint $table) {
            $table->id();
            $table->string('idNumber',22);
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName');
            $table->string('email');
            $table->integer('units')->nullable();
            $table->float('regular', 4, 2)->nullable();
            $table->float('overload', 4, 2)->nullable();
            $table->string('activation')->nullable();
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
        Schema::dropIfExists('facultys');
    }
}
