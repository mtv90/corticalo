<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Study;
use App\CRF;
use App\Role;

class PatientsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware(function ($request, $next) {
            
            $role = Role::find(auth()->user()->role_id);
            
            if (count($role->rights)>0) {
                return $next($request);
            }
            return redirect('/dashboard')->with('error', 'Sie haben noch keine Zugriffsrechte erhalten! Wenden sie sich an ihren Admin!');               
          
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = auth()->user()->id;
        $patients = Patient::orderBy('created_at', 'desc')->paginate(10);
        // ->where('user_id', $userid)
        $studies = Study::all();
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->patindex == 1) {
                return view('patients.index')->with('patients', $patients)->with('studies', $studies)->with('role', $role);            }
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
        $studies = Study::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->patcreate == 1) {
                return view('patients.create')->with('studies', $studies);           
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
            'vorname' => 'required',
            'nachname' => 'required',
            'geburtsdatum' => 'required',
            'geburtsort' => 'required',
        ]);

        // Create patient
            
        $patient = new Patient;
        $patient->pavorname = $request->input('vorname');
        $patient->panachname = $request->input('nachname');
        $patient->pageburtsdatum = $request->input('geburtsdatum');
        $patient->pageburtsort = $request->input('geburtsort');
        $patient->user_id = auth()->user()->id;

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->patcreate == 1) {
                $patient->save();
            
                $patient->studies()->sync($request->studies, false);
                return redirect('/patients')->with('success', 'Patient erstellt');            
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Recht!');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->patshow == 1) {
                return view('patients.show')->with('patient', $patient)->with('role', $role);           
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
        
        $patient = Patient::find($id);
        $studies = Study::all();
        
        //check for correct user
        // if(auth()->user()->id !== $patient->user_id){
        //     return redirect('/patients')->with('error', 'Kein Zugriffsrecht');
        // }  
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->patedit == 1 && auth()->user()->id == $patient->user_id) {
                return view('patients.edit')->with('patient', $patient)->with('studies', $studies);           
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

        //create form

        $patient = Patient::find($id);
        $patient->pavorname = $request->input('vorname');
        $patient->panachname = $request->input('nachname');
        $patient->pageburtsdatum = $request->input('geburtsdatum');
        $patient->pageburtsort = $request->input('geburtsort');


        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->patedit == 1) {

                $patient->save();

                $patient->studies()->sync($request->studies, true);
                return redirect('/patients')->with('success', 'Patient bearbeitet');           
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
        $patient = Patient::find($id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->patdelete == 1 && auth()->user()->id == $patient->user_id) {
                $patient -> delete();
                return redirect('/patients')->with('success', 'Patient entfernt');           
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
  
    }
}
