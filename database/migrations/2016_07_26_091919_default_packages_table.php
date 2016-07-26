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
            $table->string('name');
            $table->string('billing_type')->nullable();
            $table->string('disk_space')->nullable();
            $table->string('total_disk_space_price')->nullable();
            $table->string('bandwith')->nullable();
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
        //
    }
}
