<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResultidToYearresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('yearresults', function (Blueprint $table) {
            $table->integer('result_id')->after('answeryear')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('yearresults', function (Blueprint $table) {
            $table->dropColumn('result_id')->after('answeryear');
        });
    }
}
