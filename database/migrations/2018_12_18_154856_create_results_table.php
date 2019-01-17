<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('crf_id')->unsigned();
            $table->foreign('crf_id')->references('id')->on('crfs');

            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patient');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('study_id')->unsigned();
            $table->foreign('study_id')->references('id')->on('studies');

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
        Schema::dropIfExists('results');
    }
}
