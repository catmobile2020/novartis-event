<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaRateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_rate_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('option');
            $table->unsignedBigInteger('agenda_rate_questions_id')->index();
            $table->foreign('agenda_rate_questions_id')->references('id')->on('agenda_rate_questions')->onDelete('cascade');
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
        Schema::dropIfExists('agenda_rate_options');
    }
}
