<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing',function (Blueprint $table){
            $table->increments('id');
            $table->string('user_id');
            $table->string('doc_ref_no');
            $table->string('amount');
            $table->string('amount_used')->nullable();
            $table->string('amount_left')->nullable();
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
        Schema::drop('billing');
    }
}
