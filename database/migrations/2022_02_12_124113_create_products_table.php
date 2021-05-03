<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('volume')->nullable();
            $table->integer('units')->nullable();
            $table->double('price')->nullable();
            $table->text('advantages')->nullable();
            $table->text('disadvantages')->nullable();
            $table->text('notes')->nullable();
            $table->text('directions_of_use')->nullable();
            $table->string('product_photo')->default('default_product.png');
            $table->string('code')->nullable();
            $table->bigInteger('form_id')->unsigned();
            $table->bigInteger('line_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade');
            $table->foreign('line_id')->references('id')->on('lines')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
