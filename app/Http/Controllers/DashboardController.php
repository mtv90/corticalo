<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\CRF;
use App\Form;
use App\Study;
use App\Formtype;
use App\Role;
use App\Result;
use App\Patient;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $role_id = auth()->user()->role_id;
        $user = User::find($user_id);
        $formtypes = Formtype::all();
        $role = Role::find($role_id);
        $fragen = Form::all();
        $patients = Patient::all();

        $studies = Study::all();
        // Ansicht über meine erstellten Inhalte im Dashboard
        $myStudies = Study::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(5);
        $crfs = CRF::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(5);
        $forms = Form::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(5);


        //Ansicht für Studienanwender
        $user->patients = DB::table('patient')
        ->join('users', 'patient.user_id', '=', 'users.id')
        ->select('users.vorname', 'users.nachname', 'patient.*')
        ->orderBy('created_at', 'desc')->paginate(5);

        $mypatients = Patient::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(5);
        
        $user->results = DB::table('results')
            ->join('crfs', 'results.crf_id', '=', 'crfs.id')
            ->where('results.user_id', $user_id)
            ->select('results.*', 'crfs.crfName')
            ->orderBy('results.created_at', 'desc')->paginate(5);

        return view('dashboard')->with('forms', $forms)->with('formtypes',$formtypes)->with('crfs', $crfs)
        ->with('studies', $studies)->with('myStudies', $myStudies)->with('role', $role)->withFragen($fragen)->with('patients', $user->patients)->with('mypatients', $mypatients)->with('results', $user->results);
    }

    public function getcrfs($id){

        $study = Study::find($id);
      
        return view('getcrfs')->with('study', $study);
    }

    public function getstudy($id){
        $study = Study::find($id);
      
        return view('getstudy')->with('study', $study);
    }
}
