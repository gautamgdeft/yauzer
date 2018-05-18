<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_category_id')->unsigned();
            $table->integer('blog_contributor_id')->unsigned();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('avatar')->nullable();
            $table->string('metatitle')->nullable();
            $table->text('metakeywords')->nullable();
            $table->text('metadescription')->nullable();
            $table->string('slug');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('blogs');
    }
}
