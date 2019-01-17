<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResultidToIntegerresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('integerresults', function (Blueprint $table) {
            $table->integer('result_id')->after('answerinteger')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('integerresults', function (Blueprint $table) {
            $table->dropColumn('result_id')->after('answerinteger');
        });
    }
}
