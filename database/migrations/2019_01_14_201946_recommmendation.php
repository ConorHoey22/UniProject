<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Recommmendation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genres');
            $table->string('words');
            $table->string('ageRange');
            $table->string('location');
            $table->string('instruments');
            $table->string('similarity');
            $table->integer('user_id');
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
        Schema::dropIfExists('recommendation');
    }
}
