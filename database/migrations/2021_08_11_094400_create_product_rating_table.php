<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_rating', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned(20);
            $table->foreign('product_id')->references('id')->on('product');
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
        Schema::dropIfExists('product_rating');
    }
}
