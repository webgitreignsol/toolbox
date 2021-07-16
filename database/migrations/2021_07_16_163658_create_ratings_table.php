<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ride_id')->unsigned(20);
            $table->foreign('ride_id')->references('id')->on('rides');
            $table->bigInteger('driver_id')->unsigned(20);
            $table->foreign('driver_id')->references('id')->on('users');
            $table->bigInteger('passenger_id')->unsigned(20);
            $table->foreign('passenger_id')->references('id')->on('users');
            $table->integer('rating');
            $table->string('comments');
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
        Schema::dropIfExists('ratings');
    }
}
