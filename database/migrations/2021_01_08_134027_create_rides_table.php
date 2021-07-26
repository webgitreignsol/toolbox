<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->integer('passenger_id');
            $table->integer('driver_id');
            $table->string('drop_off');
            $table->string('pick_up');
            $table->time('accepted_at');
            $table->time('start_at');
            $table->time('cancel_at');
            $table->time('completed_at');
            $table->integer('type');
            $table->integer('fare');
            $table->integer('status');
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
        Schema::dropIfExists('rides');
    }
}
