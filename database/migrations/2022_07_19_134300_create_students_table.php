<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('username', 20)->unique();
            $table->string('name', 50);
            $table->char('gender', 1)->default('0');
            $table->date('date_of_birth');
            $table->string('place_of_birth', 200)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('phone', 10)->unique()->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('password');
            $table->char('active', 1)->default('1');
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
        Schema::dropIfExists('students');
    }
}
