<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_packages',function (Blueprint $table){
            $table->increments('id');
            $table->string('billing_type')->nullable();
            $table->string('disk_space')->nullable();
            $table->string('total_disk_space_price')->nullable();
            $table->string('allocated_bandwith')->nullable();
            $table->string('allocated_airtime')->nullable();
            $table->string('allocated_number_of_plays')->nullable();
            $table->string('can_exceed')->nullable();
            $table->string('monthly_price')->nullable();
            $table->string('bandwidth_rates')->nullable();
            $table->string('air_time_rate')->nullable();
            $table->string('per_play_rate')->nullable();
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
        Schema::drop('default_packages');
    }
}
