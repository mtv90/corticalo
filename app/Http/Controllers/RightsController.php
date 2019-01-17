<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Right;
use App\Role;

class RightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _construct(){

        //Berechtigung prüfen
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            
            $role = Role::find(auth()->user()->role_id);
            if (count($role->rights)>0) {
                return $next($request);
            }
            return redirect('/dashboard')->with('error', 'Sie haben noch keine Zugriffsrechte erhalten! Wenden sie sich an ihren Admin!');               
          
        });
    }

    public function index()
    {
        $rights = Right::all();
             
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->rightindex == 1) {
                return view('rights.index')->with('rights', $rights);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        $adrole = Role::find(auth()->user()->role_id);

        foreach ($adrole->rights as $right) {
            if ($right->rightcreate == 1) {
                return view('rights.create')->with('roles', $roles);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'rightname' => 'required'
        ]);

        
        //speichere die Inhalte

        $right = new Right;
        $right->rightname = $request->input('rightname');
        // speicher Studienbereich
        $right->studindex = $request->has('studindex');
        $right->studishow = $request->has('studishow');
        $right->studicreate = $request->has('studicreate');
        $right->studiedit = $request->has('studiedit');
        $right->studidelete = $request->has('studidelete');
        // speicher CRFbereich
        $right->crfindex = $request->has('crfindex');
        $right->crfshow = $request->has('crfshow');
        $right->crfcreate = $request->has('crfcreate');
        $right->crfedit = $request->has('crfedit');
        $right->crfdelete = $request->has('crfdelete');
        // speicher Fragenbereich
        $right->formindex = $request->has('formindex');
        $right->formshow = $request->has('formshow');
        $right->formcreate = $request->has('formcreate');
        $right->formedit = $request->has('formedit');
        $right->formdelete = $request->has('formdelete');
        // speicher Auswahlenbereich
        $right->choiceindex = $request->has('choiceindex');
        $right->choiceshow = $request->has('choiceshow');
        $right->choicecreate = $request->has('choicecreate');
        $right->choiceedit = $request->has('choiceedit');
        $right->choicedelete = $request->has('choicedelete');
        // speicher Befragungsbereich
        $right->resultindex = $request->has('resultindex');
        $right->resultshow = $request->has('resultshow');
        $right->resultcreate = $request->has('resultcreate');
        $right->resultedit = $request->has('resultedit');
        $right->resultdelete = $request->has('resultdelete');
        // speicher Patientenbereich
        $right->patindex = $request->has('patindex');
        $right->patshow = $request->has('patshow');
        $right->patcreate = $request->has('patcreate');
        $right->patedit = $request->has('patedit');
        $right->patdelete = $request->has('patdelete');
        // speicher Userbereich
        $right->userindex = $request->has('userindex');
        $right->usershow = $request->has('usershow');
        $right->usercreate = $request->has('usercreate');
        $right->useredit = $request->has('useredit');
        $right->userdelete = $request->has('userdelete');
        //speicher Rollenbereich
        $right->roleindex = $request->has('roleindex');
        $right->roleshow = $request->has('roleshow');
        $right->rolecreate = $request->has('rolecreate');
        $right->roleedit = $request->has('roleedit');
        $right->roledelete = $request->has('roledelete');
        //speicher Rechtebereich
        $right->rightindex = $request->has('rightindex');
        $right->rightshow = $request->has('rightshow');
        $right->rightcreate = $request->has('rightcreate');
        $right->rightedit = $request->has('rightedit');
        $right->rightdelete = $request->has('rightdelete');
        // speicher Ergebnisbereich
        $right->stats = $request->has('stats');

        $right->save();

        $right->roles()->sync($request->roles, false);
       
        return redirect('/rights')->with('success', 'Recht angelegt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $right = Right::find($id);

        $adrole = Role::find(auth()->user()->role_id);

        foreach ($adrole->rights as $adright) {
            if ($adright->rightshow == 1) {
                return redirect('rights.show')->with('right', $right);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $right = Right::find($id);
        $adrole = Role::find(auth()->user()->role_id);

        foreach ($adrole->rights as $adright) {
            if ($adright->rightedit == 1) {
                return redirect('rights.edit')->with('right', $right);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'rightname' => 'required'
        ]);

        
        //speichere die Inhalte

        $right = Right::find($id);
        $right->rightname = $request->input('rightname');
        // speicher Studienbereich
        $right->studindex = $request->has('studindex');
        $right->studishow = $request->has('studishow');
        $right->studicreate = $request->has('studicreate');
        $right->studiedit = $request->has('studiedit');
        $right->studidelete = $request->has('studidelete');
        // speicher CRFbereich
        $right->crfindex = $request->has('crfindex');
        $right->crfshow = $request->has('crfshow');
        $right->crfcreate = $request->has('crfcreate');
        $right->crfedit = $request->has('crfedit');
        $right->crfdelete = $request->has('crfdelete');
        // speicher Fragenbereich
        $right->formindex = $request->has('formindex');
        $right->formshow = $request->has('formshow');
        $right->formcreate = $request->has('formcreate');
        $right->formedit = $request->has('formedit');
        $right->formdelete = $request->has('formdelete');
        // speicher Auswahlenbereich
        $right->choiceindex = $request->has('choiceindex');
        $right->choiceshow = $request->has('choiceshow');
        $right->choicecreate = $request->has('choicecreate');
        $right->choiceedit = $request->has('choiceedit');
        $right->choicedelete = $request->has('choicedelete');
        // speicher Befragungsbereich
        $right->resultindex = $request->has('resultindex');
        $right->resultshow = $request->has('resultshow');
        $right->resultcreate = $request->has('resultcreate');
        $right->resultedit = $request->has('resultedit');
        $right->resultdelete = $request->has('resultdelete');
        // speicher Patientenbereich
        $right->patindex = $request->has('patindex');
        $right->patshow = $request->has('patshow');
        $right->patcreate = $request->has('patcreate');
        $right->patedit = $request->has('patedit');
        $right->patdelete = $request->has('patdelete');
        // speicher Userbereich
        $right->userindex = $request->has('userindex');
        $right->usershow = $request->has('usershow');
        $right->usercreate = $request->has('usercreate');
        $right->useredit = $request->has('useredit');
        $right->userdelete = $request->has('userdelete');
        //speicher Rollenbereich
        $right->roleindex = $request->has('roleindex');
        $right->roleshow = $request->has('roleshow');
        $right->rolecreate = $request->has('rolecreate');
        $right->roleedit = $request->has('roleedit');
        $right->roledelete = $request->has('roledelete');
        //speicher Rechtebereich
        $right->rightindex = $request->has('rightindex');
        $right->rightshow = $request->has('rightshow');
        $right->rightcreate = $request->has('rightcreate');
        $right->rightedit = $request->has('rightedit');
        $right->rightdelete = $request->has('rightdelete');
        // speicher Ergebnisbereich
        $right->stats = $request->has('stats');

        $right->save();

        $right->roles()->sync($request->roles, true);
       
        return redirect('/rights')->with('success', 'Recht aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $right = Right::find($id);
   
        $adrole = Role::find(auth()->user()->role_id);

        foreach ($adrole->rights as $adright) {
            if ($adright->studidelete == 1) {
                $right->delete();
                return;
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }
}
