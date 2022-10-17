<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitExerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_exercise', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exercise_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->string('link', 1000);
            $table->timestamps();
            $table->foreign('exercise_id')->references('id')->on('exercises')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submit_exercise');
    }
}
