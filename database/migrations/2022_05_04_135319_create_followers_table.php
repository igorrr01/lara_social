<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('followers', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedBigInteger('follower_id');
        $table->unsignedBigInteger('leader_id');
        $table->timestamps();
        $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('leader_id')->references('id')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::drop('followers');
    }
}
