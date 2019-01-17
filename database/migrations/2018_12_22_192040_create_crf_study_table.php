<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrfStudyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crf_study', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crf_id')->unsigned();
            $table->foreign('crf_id')->references('id')->on('crfs')->onDelete('cascade');

            $table->integer('study_id')->unsigned();
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crf_study');
    }
}
