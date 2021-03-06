<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edited_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('units')->nullable();
            $table->double('price')->nullable();
            $table->text('advantages')->nullable();
            $table->text('disadvantages')->nullable();
            $table->text('notes')->nullable();
            $table->text('directions_of_use')->nullable();
            $table->text('product_photo')->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('request_type')->default(1)->comment('1-> Edit ; 2-> Delete');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('form_id')->unsigned()->nullable();
            $table->bigInteger('line_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->tinyInteger('approved')->default(0)->comment('0->Not Yet; 1-> Approved; 2-> Rejected');
            $table->bigInteger('approved_by')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade');
            $table->foreign('line_id')->references('id')->on('lines')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edited_products');
    }
}
