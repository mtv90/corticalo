<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormidToIntegerresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('integerresults', function (Blueprint $table) {
            $table->integer('form_id')->after('result_id')->onDelete('cascade');
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
            $table->dropColumn('form_id')->after('result_id');
        });
    }
}
