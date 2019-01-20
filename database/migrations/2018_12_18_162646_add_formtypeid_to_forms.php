<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormtypeidToForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms', function($table) {
            $table->integer('formtype_id')->after('frtext');
            $table->integer('format_id')->after('formtype_id')->nullable();
            $table->integer('unit_id')->after('format_id')->nullable();
            $table->integer('range_id')->after('unit_id')->nullable();
            $table->integer('user_id')->after('range_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forms', function($table) {
            $table->dropColumn('formtype_id')->after('frtext');
            $table->dropColumn('format_id')->after('formtype_id');
            $table->dropColumn('unit_id')->after('format_id');
            $table->dropColumn('range_id')->after('unit_id');
            $table->dropColumn('user_id')->after('range_id');
        });
    }
}
