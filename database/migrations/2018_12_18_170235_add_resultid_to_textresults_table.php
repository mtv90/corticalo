<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResultidToTextresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('textresults', function (Blueprint $table) {
            $table->integer('result_id')->after('answertext')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('textresults', function (Blueprint $table) {
            $table->dropColumn('result_id')->after('answertext');
        });
    }
}
