<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoiceResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choice_result', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('choice_id')->unsigned();
            $table->foreign('choice_id')->references('id')->on('choices')->onDelete('cascade');

            $table->integer('result_id')->unsigned();
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choice_result');
    }
}
