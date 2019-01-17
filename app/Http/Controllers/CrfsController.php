<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Choice;
use App\CRF;
use App\Form;
use App\Formtype;
use App\Study;
use App\Role;
use DB;

class CrfsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        
        $crfs = CRF::orderBy('created_at', 'desc')->paginate(5);
        $fragen = Form::all();
        $studies = Study::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfindex == 1) {
                return view('crfs.index')->with('role', $role)->with('crfs', $crfs)->with('fragen', $fragen)->with('studies', $studies);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

    /**
     * Show the crf for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forms = Form::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfcreate == 1) {
                return view('crfs.create')->with('forms', $forms);
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
        $this->validate($request, [
            'crfName' => 'required'
        ]);

        $crf = new CRF;
        $crf->crfName = $request->input('crfName');
        
        $crf->user_id = auth()->user()->id;
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfcreate == 1) {
                $crf->save();
                $crf->forms()->sync($request->forms, false);
                $crf->studies()->sync($request->studies, false);
        
                return redirect('/crfs')->with('success', 'CRF erstellt!');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');



    }

    public function storeFromDash(Request $request)
    {
        $this->validate($request, [
            'crfName' => 'required'
        ]);

        //create Bookmark
        $crf = new CRF;
        $crf->crfName = $request->input('crfName');
        $crf->user_id = auth()->user()->id;
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfcreate == 1) {
                $crf->save();
                $crf->forms()->sync($request->forms, false);
                $crf->studies()->sync($request->studies, false);
                return redirect('/dashboard')->with('success', 'CRF erstellt!');
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
        $crf = CRF::find($id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfshow == 1) {
                return view('crfs.show')->with('role', $role)->with('crf', $crf)->with('forms', $crf->forms);
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
        $crf = CRF::find($id);
        $formtypes = Formtype::all();

        $forms = Form::all();
        $forms2 = array();
        foreach( $forms as $form ){
            $forms2[ $form->id ] = $form->frtext;
        }

        $studies = Study::all();
        $studies2 = array();
        foreach( $studies as $study ){
            $studies2[ $study->id ] = $study->studyname;
        }
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfedit == 1 || auth()->user()->id == $crf->user_id) {
                return view('crfs.edit')->with('crf', $crf)->with('forms' , $forms)->with('formtypes', $formtypes)->with('studies' , $studies);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

    public function addForm(Request $request)
    {
        $this -> validate($request, [
            'frtext' => 'required',
            'formtype_id' => 'required',

        ]);

        //create form
            
        $form = new Form;
        $form->frtext = $request->input('frtext');
        $form->user_id = auth()->user()->id;
        $form->formtype_id = $request->formtype_id;

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formcreate == 1) {
                $form->save();

                return redirect('/crfs/{{$crf->id}}')->with('success', 'Frage mit Axios erstellt');
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
            'crfName' => 'required'
           
        ]);
        //create form

        $crf = CRF::find($id);
        $crf->crfName = $request->input('crfName');
       
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfedit == 1 || auth()->user()->id == $crf->user_id) {
                $crf->save();
                $crf->forms()->sync($request->forms, true);
                $crf->studies()->sync($request->studies, true);       
        
                return redirect('/crfs')->with('success', 'Frage bearbeitet');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');

    }

   
    public function destroy($id)
    {
        $crf = CRF::find($id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfdelete == 1 || auth()->user()->id == $crf->user_id) {
                $crf -> delete();
                return;
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
         
    }

    public function destroyAsync($id)
    {
        $crf = CRF::find($id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->crfdelete == 1 || auth()->user()->id == $crf->user_id) {
                $crf -> delete();
                return redirect('/crfs')->with('success', 'CRF erfolgreich gelöscht');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
         
    }

}
