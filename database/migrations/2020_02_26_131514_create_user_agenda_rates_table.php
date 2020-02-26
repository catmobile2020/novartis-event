<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAgendaRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_agenda_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('value')->nullable();
            $table->unsignedBigInteger('agenda_rate_questions_id')->index();
            $table->foreign('agenda_rate_questions_id')->references('id')->on('agenda_rate_questions')->onDelete('cascade');

            $table->unsignedBigInteger('agenda_rate_options_id')->nullable();
            $table->foreign('agenda_rate_options_id')->references('id')->on('agenda_rate_options')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::dropIfExists('user_agenda_rates');
    }
}
