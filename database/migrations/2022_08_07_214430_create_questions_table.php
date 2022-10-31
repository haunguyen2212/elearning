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
            $table->string('question', 1000);
            $table->char('correct_answer', 1);
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('answer_c')->nullable();
            $table->string('answer_d')->nullable();
            $table->string('image', 100)->nullable();
            $table->string('explain', 3000)->nullable();
            $table->char('level', 1)->default('1');
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->bigInteger('subject_id')->unsigned();
            $table->char('shared', 1)->default('0');
            $table->timestamps();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade')->onDelete('cascade');
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
