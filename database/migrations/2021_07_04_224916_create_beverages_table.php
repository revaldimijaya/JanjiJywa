<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beverages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('beverage_type_id')->references('id')->on('beverage_types')->cascadeOnUpdate();
            $table->string('name');
            $table->integer('price');
            $table->integer('stock');
            $table->string('image');
            $table->string('description');
            $table->string('custom_topping');
            $table->string('custom_ice');
            $table->string('custom_sugar');
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
        Schema::dropIfExists('beverages');
    }
}
