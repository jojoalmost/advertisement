<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('video');
            $table->integer('max_played');
            $table->integer('played')->default(0);
            $table->integer('skip_duration');
            $table->string('skipped');
            $table->integer('sorting')->default(0);
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
        Schema::drop('advertisement');
    }
}
