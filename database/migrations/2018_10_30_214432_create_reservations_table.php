<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->string('organization');
            $table->string('phone');
            $table->integer('population');
            $table->integer('year');
            $table->integer('month');
            $table->integer('day');
            $table->string('blocks');
            $table->string('credential');
            $table->string('remarks')->nullable();
            $table->boolean('review')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
