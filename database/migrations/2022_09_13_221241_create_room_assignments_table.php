<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('registration_id')->unsigned();
            $table->bigInteger('room_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('registration_id')->references('id')->on('room_registrations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_assignments');
    }
}
