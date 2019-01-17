<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResultidToTimeresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timeresults', function (Blueprint $table) {
            $table->integer('result_id')->after('answertime')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timeresults', function (Blueprint $table) {
            $table->dropColumn('result_id')->after('answertime');
        });
    }
}
