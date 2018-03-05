<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->boolean('sun_status')->default(false);
            $table->string('sun_open')->nullable();
            $table->string('sun_close')->nullable();
            $table->boolean('mon_status')->default(false);
            $table->string('mon_open')->nullable();
            $table->string('mon_close')->nullable();
            $table->boolean('tue_status')->default(false);
            $table->string('tue_open')->nullable();
            $table->string('tue_close')->nullable();
            $table->boolean('wed_status')->default(false);
            $table->string('wed_open')->nullable();
            $table->string('wed_close')->nullable();
            $table->boolean('thur_status')->default(false);
            $table->string('thur_open')->nullable();
            $table->string('thur_close')->nullable();
            $table->boolean('fri_status')->default(false);
            $table->string('fri_open')->nullable();
            $table->string('fri_close')->nullable();
            $table->boolean('sat_status')->default(false);
            $table->string('sat_open')->nullable();
            $table->string('sat_close')->nullable();
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
        Schema::dropIfExists('business_hours');
    }
}
