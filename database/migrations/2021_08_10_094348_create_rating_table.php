<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ride_id')->unsigned(20);
            $table->foreign('ride_id')->references('id')->on('rides');
            $table->bigInteger('get_review')->unsigned(20);
            $table->foreign('get_review')->references('id')->on('users');
            $table->bigInteger('reviewed_by')->unsigned(20);
            $table->foreign('reviewed_by')->references('id')->on('users');
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
        Schema::dropIfExists('rating');
    }
}
