<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_rating', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shop_id')->unsigned(20);
            $table->foreign('shop_id')->references('id')->on('shops');
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
        Schema::dropIfExists('shop_rating');
    }
}
