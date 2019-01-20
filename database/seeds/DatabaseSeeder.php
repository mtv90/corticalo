<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rights')->insert([
            'rightname' => 'adminrights',
            'studindex' => 1,
            'studishow' => 1,
            'studicreate' => 1,
            'studiedit' => 1,
            'studidelete' => 1,
            'crfindex' => 1,
            'crfshow' => 1,
            'crfcreate' => 1,
            'crfedit' => 1,
            'crfdelete' => 1,
            'formindex' => 1,
            'formshow' => 1,
            'formcreate' => 1,
            'formedit' => 1,
            'formdelete' => 1,
            'choiceindex' => 1,
            'choiceshow' => 1,
            'choicecreate' => 1,
            'choiceedit' => 1,
            'choicedelete' => 1,
            'resultindex' => 1,
            'resultshow' => 1,
            'resultcreate' => 1,
            'resultedit' => 1,
            'resultdelete' => 1,
            'patindex' => 1,
            'patshow' => 1,
            'patcreate' => 1,
            'patedit' => 1,
            'patdelete' => 1,
            'userindex' => 1,
            'usershow' => 1,
            'usercreate' => 1,
            'useredit' => 1,
            'userdelete' => 1,
            'roleindex' => 1,
            'roleshow' => 1,
            'rolecreate' => 1,
            'roleedit' => 1,
            'roledelete' => 1,
            'rightindex' => 1,
            'rightshow' => 1,
            'rightcreate' => 1,
            'rightedit' => 1,
            'rightdelete' => 1,
            'stats' => 1,
            
        ]);
        DB::table('roles')->insert([
            'roletype' => 'Administrator'
        ]);
        DB::table('right_role')->insert([
            'right_id' => 1,
            'role_id' => 1
        ]);

        DB::table('rights')->insert([
            'rightname' => 'studyrights',
            'studindex' => 1,
            'studishow' => 1,
            'studicreate' => 1,
            'studiedit' => 1,
            'studidelete' => 1,
            'crfindex' => 1,
            'crfshow' => 1,
            'crfcreate' => 1,
            'crfedit' => 1,
            'crfdelete' => 1,
            'formindex' => 1,
            'formshow' => 1,
            'formcreate' => 1,
            'formedit' => 1,
            'formdelete' => 1,
            'choiceindex' => 1,
            'choiceshow' => 1,
            'choicecreate' => 1,
            'choiceedit' => 1,
            'choicedelete' => 1,
            'resultindex' => 0,
            'resultshow' => 0,
            'resultcreate' => 0,
            'resultedit' => 0,
            'resultdelete' => 0,
            'patindex' => 0,
            'patshow' => 0,
            'patcreate' => 0,
            'patedit' => 0,
            'patdelete' => 0,
            'userindex' => 1,
            'usershow' => 1,
            'usercreate' => 0,
            'useredit' => 1,
            'userdelete' => 0,
            'roleindex' => 0,
            'roleshow' => 0,
            'rolecreate' => 0,
            'roleedit' => 0,
            'roledelete' => 0,
            'rightindex' => 0,
            'rightshow' => 0,
            'rightcreate' => 0,
            'rightedit' => 0,
            'rightdelete' => 0,
            'stats' => 1,
            
        ]);
        DB::table('roles')->insert([
            'roletype' => 'Studienleiter'
        ]);
        DB::table('right_role')->insert([
            'right_id' => 2,
            'role_id' => 2
        ]);
        
        DB::table('rights')->insert([
            'rightname' => 'doctorrights',
            'studindex' => 0,
            'studishow' => 0,
            'studicreate' => 0,
            'studiedit' => 0,
            'studidelete' => 0,
            'crfindex' => 0,
            'crfshow' => 0,
            'crfcreate' => 0,
            'crfedit' => 0,
            'crfdelete' => 0,
            'formindex' => 0,
            'formshow' => 0,
            'formcreate' => 0,
            'formedit' => 0,
            'formdelete' => 0,
            'choiceindex' => 0,
            'choiceshow' => 0,
            'choicecreate' => 0,
            'choiceedit' => 0,
            'choicedelete' => 0,
            'resultindex' => 1,
            'resultshow' => 1,
            'resultcreate' => 1,
            'resultedit' => 1,
            'resultdelete' => 1,
            'patindex' => 1,
            'patshow' => 1,
            'patcreate' => 1,
            'patedit' => 1,
            'patdelete' => 1,
            'userindex' => 1,
            'usershow' => 1,
            'usercreate' => 0,
            'useredit' => 1,
            'userdelete' => 0,
            'roleindex' => 0,
            'roleshow' => 0,
            'rolecreate' => 0,
            'roleedit' => 0,
            'roledelete' => 0,
            'rightindex' => 0,
            'rightshow' => 0,
            'rightcreate' => 0,
            'rightedit' => 0,
            'rightdelete' => 0,
            'stats' => 1,
            
        ]);
        DB::table('roles')->insert([
            'roletype' => 'Arzt'
        ]);
        DB::table('right_role')->insert([
            'right_id' => 3,
            'role_id' => 3
        ]);

        DB::table('users')->insert([
            'vorname' => John,
            'nachname' => Doe,
            'email' => 'john@doe.com',
            'password' => bcrypt('secret'),
            'role_id' => '1'
        ]);

        DB::table('users')->insert([
            'vorname' => Peter,
            'nachname' => Lustig,
            'email' => 'peter@lustig.com',
            'password' => bcrypt('secret'),
            'role_id' => '2'
        ]);

        DB::table('users')->insert([
            'vorname' => Max,
            'nachname' => Muster,
            'email' => 'max@muster.com',
            'password' => bcrypt('secret'),
            'role_id' => '3'
        ]);

        DB::table('formats')->insert([
            'formats' => 'Textfeld'
            ]);
        DB::table('formats')->insert([
            'formats' => 'Textarea'
            ]);
        DB::table('formats')->insert([
            'formats' => 'Datum'
            ]);
        DB::table('formats')->insert([
            'formats' => 'Uhrzeit'
            ]);
        DB::table('formats')->insert([
            'formats' => 'Jahr'
            ]);
        DB::table('formats')->insert([
            'formats' => 'Ganzzahl'
            ]);
        DB::table('formats')->insert([
            'formats' => 'Gleitkommazahl' 
        ]);
        DB::table('formtypes')->insert([
            'type' => 'Eingabe',
            ]);
        DB::table('formtypes')->insert([
            'type' => 'Checkbox',
            ]);
        DB::table('formtypes')->insert([
            'type' => 'Radiobutton',
        ]);
        DB::table('units')->insert([
            'einheit' => 'kg',
            ]);
        DB::table('units')->insert([
        'einheit' => 'cm',
            ]);
        DB::table('units')->insert([
        'einheit' => 'mm',
            ]);
        DB::table('units')->insert([
        'einheit' => 'm',
            ]);
        DB::table('units')->insert([
        'einheit' => 'g',
            ]);
        DB::table('units')->insert([
        'einheit' => 'mg',
            ]);
        DB::table('units')->insert([
        'einheit' => 'ml',
            ]);
        DB::table('units')->insert([
        'einheit' => 'l',
            ]);
        DB::table('units')->insert([
        'einheit' => 'mmHG',
            ]);
        DB::table('units')->insert([
        'einheit' => '°C',
            ]);
        DB::table('units')->insert([
        'einheit' => 'K',
            ]);
        DB::table('units')->insert([
        'einheit' => 'Hb',
            ]);
        DB::table('units')->insert([
        'einheit' => 'Hkt',
            ]);
        DB::table('units')->insert([
        'einheit' => 'Leuko',
            ]);
        DB::table('units')->insert([
        'einheit' => 'Ery',
            ]);
        DB::table('units')->insert([
        'einheit' => 'Thrombo',
            ]);
        DB::table('units')->insert([
        'einheit' => 'TC',
            ]);
        DB::table('units')->insert([
        'einheit' => 'LDL',
            ]);
        DB::table('units')->insert([
        'einheit' => 'Hz',
            ]);

    }
}
