<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditedProductIndicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edited_product_indication', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('indication_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('indication_id')->references('id')->on('indications')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('edited_product_indication');
    }
}
