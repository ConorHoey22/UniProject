<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_genres', function (Blueprint $table) {
            $table->integer('genreID_FK')->unsigned();
            $table->foreign('genreID_FK')->references('genreID')->on('genre');
            $table->integer('userid_FK')->unsigned();
            $table->foreign('userid_FK')->references('id')->on('users');
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
        Schema::dropIfExists('users_genres');
    }
}
