<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResultidToDateresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dateresults', function (Blueprint $table) {
            $table->integer('result_id')->after('answerdate')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dateresults', function (Blueprint $table) {
            $table->dropColumn('result_id')->after('answerdate');
        });
    }
}
