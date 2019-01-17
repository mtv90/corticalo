<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rightname', 150);
            // Rechte für Studien
            $table->boolean('studindex')->default(0);
            $table->boolean('studishow')->default(0);
            $table->boolean('studicreate')->default(0);
            $table->boolean('studiedit')->default(0);
            $table->boolean('studidelete')->default(0);
            // Rechte für CRFs
            $table->boolean('crfindex')->default(0);
            $table->boolean('crfshow')->default(0);
            $table->boolean('crfcreate')->default(0);
            $table->boolean('crfedit')->default(0);
            $table->boolean('crfdelete')->default(0);
            // Rechte für Fragen
            $table->boolean('formindex')->default(0);
            $table->boolean('formshow')->default(0);
            $table->boolean('formcreate')->default(0);
            $table->boolean('formedit')->default(0);
            $table->boolean('formdelete')->default(0);
            // Rechte für Auswahlen
            $table->boolean('choiceindex')->default(0);
            $table->boolean('choiceshow')->default(0);
            $table->boolean('choicecreate')->default(0);
            $table->boolean('choiceedit')->default(0);
            $table->boolean('choicedelete')->default(0);
            // Rechte für Befragungen
            $table->boolean('resultindex')->default(0);
            $table->boolean('resultshow')->default(0);
            $table->boolean('resultcreate')->default(0);
            $table->boolean('resultedit')->default(0);
            $table->boolean('resultdelete')->default(0);
            // Rechte für Patienten
            $table->boolean('patindex')->default(0);
            $table->boolean('patshow')->default(0);
            $table->boolean('patcreate')->default(0);
            $table->boolean('patedit')->default(0);
            $table->boolean('patdelete')->default(0);
            // Rechte für User
            $table->boolean('userindex')->default(0);
            $table->boolean('usershow')->default(0);
            $table->boolean('usercreate')->default(0);
            $table->boolean('useredit')->default(0);
            $table->boolean('userdelete')->default(0);
            // Rechte für Rollen
            $table->boolean('roleindex')->default(0);
            $table->boolean('roleshow')->default(0);
            $table->boolean('rolecreate')->default(0);
            $table->boolean('roleedit')->default(0);
            $table->boolean('roledelete')->default(0);
            // Rechte für Rechte
            $table->boolean('rightindex')->default(0);
            $table->boolean('rightshow')->default(0);
            $table->boolean('rightcreate')->default(0);
            $table->boolean('rightedit')->default(0);
            $table->boolean('rightdelete')->default(0);
            // Rechte für Ergebnisse
            $table->boolean('stats')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rights');
    }
}
