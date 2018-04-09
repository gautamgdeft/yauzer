<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYauzerCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yauzer_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('yauzer_id')->unsigned();
            $table->integer('business_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('yauzer_comments');
    }
}
