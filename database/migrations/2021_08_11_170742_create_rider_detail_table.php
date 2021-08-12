<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_detail', function (Blueprint $table) {
            $table->id();
            $table->string('rider_contact');
            $table->string('rider_photo');
            $table->string('vehicle_photo');
            $table->string('vehicle_make');
            $table->string('vehicle_registration_number');
            $table->integer('rider_id');
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
        Schema::dropIfExists('rider_detail');
    }
}
