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

class DashboardUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role_id == 1) {
                return redirect('/')->with('error', 'Sie haben kein Zugriffsrecht!');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $role_id = auth()->user()->role_id;
        $user = User::find($user_id);
        $role = Role::find($role_id);


        $patients = DB::table('patient')
                ->join('users', 'patient.user_id', '=', 'users.id')
                ->select('users.name', 'patient.*')
                ->orderBy('created_at', 'desc')->paginate(5);
                
       $user->results = DB::table('results')
            ->join('crfs', 'results.crf_id', '=', 'crfs.id')
            ->where('results.user_id', $user_id)
            ->select('results.*', 'crfs.crfName')
            ->orderBy('results.created_at', 'desc')->paginate(5);

        $studies = Study::all();
        $crfs = CRF::all();

   

        return view('dashboarduser')->with('role', $role)->with('patients', $user->patients)
            ->with('results', $user->results)->with('studies', $studies)->with('crfs', $crfs);
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
