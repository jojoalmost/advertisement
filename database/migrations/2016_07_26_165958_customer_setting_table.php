<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_setting',function (Blueprint $table){
            $table->increments('id');
            $table->string('default_package_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('active')->nullable();
            $table->string('directory')->nullable();
            $table->string('credit_terms')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('max_active_videos')->nullable();
            $table->string('disk_space_available')->nullable();
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
        Schema::drop('customer_setting');
    }
}
