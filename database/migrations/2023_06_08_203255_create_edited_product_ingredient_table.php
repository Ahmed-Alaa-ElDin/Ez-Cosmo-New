<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditedProductIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edited_product_ingredient', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ingredient_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('concentration',50)->nullable();
            $table->string('role',255)->nullable();

            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('edited_products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edited_product_ingredient');
    }
}
