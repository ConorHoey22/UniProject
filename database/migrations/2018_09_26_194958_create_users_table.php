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
            $table->string('ageRange')->nullable(); // Only for Band
            $table->string('userAge');
            $table->string('country');
            $table->string('location');
            $table->string('userType');
            $table->string('genre')->nullable(); // only for Artist/Band
            $table->string('profileDescription')->nullable();
            $table->string('soundCloudWidget')->nullable(); //  only for Artist/Band
            $table->string('soundCloudProfile')->nullable(); // only for Artist/Band
            $table->string('spotifyProfile')->nullable(); // only for Artist/Band
            $table->string('word1')->nullable(); // only for Artist/Band 
            $table->string('word2')->nullable(); // only for Artist/Band
            $table->string('word3')->nullable(); // only for Artist/Band
            $table->string('word4')->nullable(); // only for Artist/Band
            $table->string('word5')->nullable(); // only for Artist/Band
            $table->string('similarity')->nullable(); //    only for Artist/Band
            $table->string('instruments')->nullable(); //   only for Artist/Band
            $table->string('image')->default('default.jpg');
            
//Recommendation Fields
            $table->string('recommendationGenre');
            $table->string('recommendationWord1'); // How do we store more than one
            $table->string('recommendationWord2'); // How do we store more than one
            $table->string('recommendationWord3'); // How do we store more than one
            $table->string('recommendationWord4'); // How do we store more than one
            $table->string('recommendationWord5'); // How do we store more than one

            $table->string('recommendationAge'); 
            $table->string('recommendationAgeRange'); 
            $table->string('recommendationCountry'); 
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
