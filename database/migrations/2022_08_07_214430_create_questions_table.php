<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quiz_id')->unsigned();
            $table->string('question', 1000);
            $table->string('image', 100)->nullable();
            $table->char('correct_answer', 1);
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('answer_c')->nullable();
            $table->string('answer_d')->nullable();
            $table->timestamps();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
