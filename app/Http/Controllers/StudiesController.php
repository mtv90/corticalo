<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Study;
use App\User;
use App\CRF;
use App\Patient;
use App\Result;
use App\Role;
use App\Right; 
use DB;

class StudiesController extends Controller
{

    public function __construct()
    {
        // Berechtigungen prüfen
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

        $studies = Study::orderBy('created_at', 'desc')->paginate(5);
        $crfs = CRF::orderBy('created_at', 'desc')->paginate(5);
        $patients = Patient::all();
        
        $role = Role::find(auth()->user()->role_id);
        
        foreach ($role->rights as $right) {
            if ($right->studindex == 1) {
                return view('studies.index')->with('studies', $studies)->with('crfs', $crfs)->with('patients', $patients)->with('role', $role);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');

        
    }

    public function statistics()
    {   
        // $results = Result::orderBy('created_at', 'desc')

        $results = DB::table('results')
            // ->join('patient', 'results.patient_id', '=', 'patient.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->join('crfs', 'results.crf_id', '=', 'crfs.id')
            ->select('results.*', 'crfs.crfName','users.vorname', 'users.nachname')
            ->orderBy('created_at', 'desc')->paginate(5);
    
        $studies = Study::orderBy('created_at', 'desc')->paginate(5);
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->stats == 1) {
                return view('studies.stats')->with('results', $results)->with('studies', $studies)->with('role', $role);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }

    public function showanswer($id){

        $result = Result::find($id);
        $patients = Patient::all();
        
        //hole der Antwort zugehörigen CRF
        $crfid = $result->crf_id;
        $crf = CRF::find($crfid);

        //zugehöriger Patient 
        $patient = Patient::find($result->patient_id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->resultshow == 1) {
                return view('getdetails')->with('crf', $crf)->with('forms', $result->forms)->with('patient', $patient)->with('result', $result);
            }
        }
        return redirect()->with('error', 'Sie haben kein Zugriffsrecht!');
    }


    public function showOverview(Request $request){

        $request->session()->put('study', $request->input('studyname'));
        $request->session()->put('director', $request->input('director'));
        $request->session()->put('description', $request->input('studydescription'));
        $request->session()->put('userID', auth()->user()->id);
        
        $request->session()->put('crfs', $request->crfs);
        $request->session()->put('patients', $request->patients);
                
        return view('/studies/overview')->with('request', $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crfs = CRF::all();
        $patients = Patient::all();
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->studicreate == 1 && $right->studindex == 1 && $right->crfindex == 1 && $right->crfcreate == 1 && $right->formindex == 1 && $right->formcreate == 1) {
                return view('studies.create')->with('crfs', $crfs)->with('patients', $patients);
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
        
        $data = $request->session()->all();
        $study = new Study;

        if (isset($data)) {
            $study->studyname = $request->session()->pull('study');
            $study->director = $request->session()->pull('director');
            $study->studydescription = $request->session()->pull('description');
            $study->user_id = auth()->user()->id;
            
        }else {
            return redirect('/studies')->with('error', 'Es ist ein Fehler aufgetreten!');
        }
        

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->studicreate == 1) {
                $study->save();

                $study->crfs()->sync($request->session()->pull('crfs'), false);
                $study->patients()->sync($request->session()->pull('patients'), false);          

                return redirect('/studies')->with('success', 'Studie erstellt!');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');

    }

    public function storeFrom(Request $request)
    {
        $this->validate($request, [
            'studyname' => 'required',
            'studydescription' => 'required',
            'director' => 'required'
        ]);

        $study = new Study;
        $study->studyname = $request->input('studyname');
        $study->director = $request->input('director');
        $study->studydescription = $request->input('studydescription');
        $study->user_id = auth()->user()->id;
    
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->studicreate == 1) {
                $study->save();
                $study->crfs()->sync($request->crfs, false);
                $study->patients()->sync($request->patients, false);
                return redirect('/dashboard')->with('success', 'Studie erstellt!');
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
        $study = Study::find($id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->studishow == 1) {
                return view('studies.show')->with('role', $role)->with('study', $study)->with('crfs', $study->crfs)->with('patients', $study->patients);
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
        $study = Study::find($id);

        $patients = Patient::all();  
        $crfs = CRF::all();
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->studiedit == 1 || auth()->user()->id == $study->user_id) {
                return view('studies.edit')->with('study', $study)->with('crfs' , $crfs)->with('patients' , $patients);
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
            'studyname' => 'required',
            'director' => 'required',
            'studydescription' => 'required'
        ]);
        //create form

        $study = Study::find($id);
        $study->studyname = $request->input('studyname');
        $study->director = $request->input('director');
        $study->studydescription = $request->input('studydescription');

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->studiedit == 1) {
                $study->save();

                $study->crfs()->sync($request->crfs, true);
                $study->patients()->sync($request->patients, true);
                return redirect('/studies')->with('success', 'Studie bearbeitet');            
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
        $study = Study::find($id);
   
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->studidelete == 1 || auth()->user()->id == $study->user_id) {
                $study->delete();
                return;
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

}
