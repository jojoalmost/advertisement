<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('username')->nullable();
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('role')->nullable();
            $table->string('key')->nullable();
            $table->string('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('role');
            $table->dropColumn('key');
            $table->dropColumn('active');
        });
    }
}
