<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_cms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description_ckeditor')->nullable();
            $table->text('first_section')->nullable();
            $table->text('second_section')->nullable();
            $table->text('third_section')->nullable();
            $table->text('copyright_info')->nullable();
            $table->string('default_bg_image')->nullable();
            $table->string('picture_coming_soon')->nullable();
            $table->string('signup_bg_image')->nullable();
            $table->string('login_bg_image')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('site_cms');
    }
}
