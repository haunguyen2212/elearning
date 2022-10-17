<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exercise_id')->unsigned();
            $table->string('name', 100)->nullable();
            $table->string('link', 1000);
            $table->char('is_show', 1)->default('1');
            $table->timestamps();
            $table->foreign('exercise_id')->references('id')->on('exercises')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercise_documents');
    }
}
