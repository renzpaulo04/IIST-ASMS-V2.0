<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('idNumber')->unique();
            $table->string('email')->unique();
            $table->string('lastName');
            $table->string('firstName');
            $table->string('middleName');
            $table->integer('units')->nullable();
            $table->float('regular', 4, 2)->nullable();
            $table->float('overload', 4, 2)->nullable();
            $table->string('contactNumber');
            $table->string('password');
            $table->string('role');
            $table->string('role2')->nullable();
            $table->string('status')->nullable();
            $table->string('student_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('accepted_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
