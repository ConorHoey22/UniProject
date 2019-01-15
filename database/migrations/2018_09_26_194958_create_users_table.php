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
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('country');
            $table->string('location');
            $table->string('userType');
            $table->string('genre');
            $table->string('profileDescription');
            $table->string('soundCloudWidget');
            $table->string('soundCloudProfile');

            // $table->string('dailyMusicMatch')->default('Default'); //CHange this , may create a bug
            $table->remembertoken(); /*BUG*/
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
