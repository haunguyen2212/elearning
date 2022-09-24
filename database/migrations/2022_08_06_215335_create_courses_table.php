<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('code', 10)->unique();
            $table->bigInteger('school_year_id')->unsigned()->nullable();
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->string('introduce', 1000)->nullable();
            $table->string('notice', 3000)->nullable();
            $table->char('is_enrol', 1)->default('1');
            $table->char('is_show', 1)->default('1');
            $table->timestamps();
            $table->foreign('school_year_id')->references('id')->on('school_years')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
