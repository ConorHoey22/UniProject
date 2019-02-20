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
            $table->string('ageRange'); // Only for Band
            $table->string('userAge');
            $table->string('country');
            $table->string('location');
            $table->string('userType');
            $table->string('genre'); // only for Artist/Band
            $table->string('profileDescription');
            $table->string('soundCloudWidget'); //  only for Artist/Band
            $table->string('soundCloudProfile'); // only for Artist/Band
            $table->string('word1'); // only for Artist/Band 
            $table->string('word2'); // only for Artist/Band
            $table->string('word3'); // only for Artist/Band
            $table->string('word4'); // only for Artist/Band
            $table->string('word5'); // only for Artist/Band
            $table->string('similarity'); //    only for Artist/Band
            $table->string('instruments'); //   only for Artist/Band
            
//Recommendation Fields
            $table->string('recommendationGenre');
            $table->string('recommendationWord1'); // How do we store more than one
            $table->string('recommendationWord2'); // How do we store more than one
            $table->string('recommendationWord3'); // How do we store more than one
            $table->string('recommendationWord4'); // How do we store more than one
            $table->string('recommendationWord5'); // How do we store more than one

            $table->string('recommendationAge'); 
            $table->string('recommendationLocation');
            $table->string('recommendationInstruments');
            $table->string('recommendationSimilarity');
            $table->string('recommendationUserType');


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
