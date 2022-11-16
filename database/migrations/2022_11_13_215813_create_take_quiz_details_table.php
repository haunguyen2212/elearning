<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTakeQuizDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_quiz_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('take_quiz_id')->unsigned();
            $table->bigInteger('question_id')->unsigned()->nullable();
            $table->char('choose', 1)->nullable();
            $table->char('correct', 1);
            $table->timestamps();
            $table->foreign('take_quiz_id')->references('id')->on('take_quiz')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('take_quiz_details');
    }
}
