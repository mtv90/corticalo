<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Right;

class RolesController extends Controller
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
        $roles = Role::orderBy('created_at', 'desc')->paginate(5);
        
        $adrole = Role::find(auth()->user()->role_id);

        foreach ($adrole->rights as $right) {
            if ($right->roleindex == 1) {
                return view('roles.index')->with('roles', $roles)->with('adrole', $adrole);
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
        $rights = Right::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->rolecreate == 1) {
                return view('roles.create')->with('rights', $rights);
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
            'roletype' => 'required'
        ]);

        // speichere die Inhalte

        $role = new Role;
        $role->roletype = $request->input('roletype');

        $adrole = Role::find(auth()->user()->role_id);

        foreach ($adrole->rights as $right) {
            if ($right->rolecreate == 1) {
                
                $role->save();
                $role->rights()->sync($request->rights, false);
                return redirect('/roles')->with('success', 'Benutzerrolle erstellt!');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!'); 

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        $admit = Role::find(auth()->user()->role_id);

        foreach ($admit->rights as $right) {
            if ($right->roleshow == 1) {
                return view('roles.show')->with('role', $role)->with('rights', $role->rights)->with('admit', $admit);
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
        $role = Role::find($id);

        $rights = Right::all();

        $admit = Role::find(auth()->user()->role_id);

        foreach ($admit->rights as $adright) {
            if ($adright->roleedit == 1 && auth()->user()->role_id == $role->id) {
                return view('roles.edit')->with('role', $role)->with('rights', $rights)->with('admit', $admit);
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
        $this->validate($request, [
            'roletype' => 'required'
        ]);

        $role = Role::find($id);
        $role->roletype = $request->input('roletype');

        $adrole = Role::find(auth()->user()->role_id);

        foreach ($adrole->rights as $right) {
            if ($right->roleedit == 1) {
                
                $role->save();
                $role->rights()->sync($request->rights, true);
                return redirect('/roles')->with('success', 'Benutzerrolle aktualisiert!');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        $adrole = Role::find(auth()->user()->role_id);
        foreach ($adrole->rights as $right) {
            if ($right->roledelete == 1) {
                $role->delete();
                return;
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }
}
