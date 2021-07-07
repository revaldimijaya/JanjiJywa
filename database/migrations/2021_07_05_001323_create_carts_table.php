<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('beverage_id')->references('id')->on('beverages');
            $table->foreignId('topping_id')->references('id')->on('toppings');
            $table->foreignId('ice_id')->references('id')->on('ices');
            $table->foreignId('sugar_id')->references('id')->on('sugar');
            $table->primary(['user_id','beverage_id']);
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
        Schema::dropIfExists('carts');
    }
}
