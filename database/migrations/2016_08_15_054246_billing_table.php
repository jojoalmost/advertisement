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
            $table->string('doc_ref_no')->nullable();
            $table->string('amount')->default(0);
            $table->string('amount_used')->default(0);
            $table->string('amount_left')->default(0);
            $table->string('notes')->nullable();
            $table->string('type')->nullable();
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
