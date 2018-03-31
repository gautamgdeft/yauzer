<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('added_by')->unsigned();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('business_category')->nullable();
            $table->string('business_subcategory')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('avatar')->default('default.png');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('premium_status')->default(false);
            $table->string('slug');
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
        Schema::dropIfExists('business_listings');
    }
}
