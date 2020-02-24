<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_practices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('practice_option_id')->index();
            $table->foreign('practice_option_id')->references('id')->on('practice_options')->onDelete('cascade');

            $table->unsignedBigInteger('practice_id')->index();
            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_practices');
    }
}
