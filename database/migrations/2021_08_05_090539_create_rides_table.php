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
            $table->integer('shop_id');
            $table->integer('customer_id');
            $table->integer('rider_id');
            $table->string('drop_off');
            $table->string('pick_up');
            $table->time('accepted_at');
            $table->time('cancell_at');
            $table->time('completed_at');
            $table->integer('cancell_by')->nullable();
            $table->string('cancel_reason');
            $table->integer('fare');
            $table->string('status');
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
