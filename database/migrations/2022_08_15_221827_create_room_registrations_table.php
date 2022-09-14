<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('purpose');
            $table->date('date');
            $table->bigInteger('teacher_id')->unsigned();
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('amount');
            $table->char('status', 2)->default('0');
            $table->timestamps();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_registrations');
    }
}
