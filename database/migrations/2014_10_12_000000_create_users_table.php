<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->default('default.png');
            $table->string('password');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('age_group')->nullable();
            $table->string('income')->nullable();
            $table->string('education')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('age')->nullable();
            $table->boolean('login_status')->default(false);
            $table->boolean('registeration_status')->default(false);
            $table->string('token')->nullable();
            $table->string('slug');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
