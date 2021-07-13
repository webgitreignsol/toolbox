<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fares', function (Blueprint $table) {
            $table->id();
            $table->string('per_mile');
            $table->string('per_minute');
            $table->string('willgo_commission');
            $table->timestamps();
        });

        DB::table('fares')->insert(
            array(
                'id' => 1,
                'per_mile' => 1,
                'per_minute' => 1,
                'willgo_commission' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fares');
    }
}
