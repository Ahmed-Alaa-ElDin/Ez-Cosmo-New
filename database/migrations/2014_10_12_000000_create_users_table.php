<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',50);
            $table->string('last_name',50)->nullable();
            $table->string('password',100);
            $table->tinyInteger('gender')->default("1")->comment('1 -> Male ; 2 -> Female');
            $table->string('phone',20)->nullable();
            $table->integer('visit_num')->default('1');
            $table->dateTime('last_visit')->nullable();
            $table->bigInteger('country_id')->unsigned();
            $table->string('profile_photo',100)->default('default_profile.png');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
