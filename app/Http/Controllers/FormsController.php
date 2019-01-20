<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\Choice;
use App\CRF;
use App\Formtype;
use App\Role;
use App\Format;
use App\Range;
use App\Unit;

class FormsController extends Controller
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

        $fragen = Form::orderBy('created_at', 'desc')->paginate(5);
        $formtypess = Formtype::all();
        $crfs = CRF::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formindex == 1) {
                return view('forms.index')->with('role', $role)->with('fragen', $fragen)->with('formtypess', $formtypess)->with('crfs', $crfs);
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
        $formtypes = Formtype::all();
        $formats = Format::all();
        $crfs = CRF::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formcreate == 1) {
                return view('forms.create')->with('formtypes', $formtypes)->with('crfs', $crfs);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

    // Asynchrone Funktion für das Create-Formular
    public function getformats($id){

        
        $type = Formtype::find($id);
        $formats = Format::all();
      
        return view('getformats')->with('formats', $formats)->with('type', $type);
    }

    // Asynchrone Funktion für das Edit-Formular
    public function geteditformats($id){
        $form = Form::find($id);
        
        $formats = Format::all();
       
        return view('geteditformats')->with('formats', $formats)->with('form', $form);
    }

     // Asynchrone Funktion für das Create-Formular
    public function getranges($id){

        $format = Format::find($id);
        $ranges = Range::all();
      
        return view('getranges')->with('ranges', $ranges)->with('format', $format);
    }

    // Asynchrone Funktion für das Edit-Formular
    public function getsavedranges($id){
        
        $form = Form::find($id);

        return view('getsavedranges')->with('form', $form);

    }

    // Asynchrone Funktion für das Create-Formular
    public function getunits(){

        $units = Unit::all();
      
        return view('getunits')->with('units', $units);
    }

    // Asynchrone Funktion für das Edit-Formular
    public function getsavedunits($id){
        
        $form = Form::find($id);
        $units = Unit::all();

        return view('getsavedunits')->with('form', $form)->with('units', $units);
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
            'frtext' => 'required',
            'formtype_id' => 'required',

        ]);
        
        //create form
        $form = new Form;
        
        $form->frtext = $request->input('frtext');
        $form->user_id = auth()->user()->id;
        $form->formtype_id = $request->formtype_id;
        $form->unit_id = $request->unit_id;
        $form->format_id = $request->format_id;
        
        if($request->min != null && $request->max != null){
            $range = new Range;
            $range->min = $request->input('min');
            $range->max = $request->input('max');
            $range->save();
            $form->range_id = $range->id;
        }
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formcreate == 1) {
                
                $form->save();

                $form->crfs()->sync($request->crfs, false);
      
                if($form->formtype_id == 2 || $form->formtype_id == 3){
                    return redirect('/forms')->with('go2choice', 'Deine Frage benötigt Auswahlmöglichkeiten! Bitte Auswahlen erstellen!') ; 
                }
                
                return redirect('/forms')->with('success', 'Frage erstellt');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Recht!');
        
    }

    public function storeForms(Request $request)
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

        $form->unit_id = $request->unit_id;
        $form->format_id = $request->format_id;
        
        if($request->min != null && $request->max != null){
            $range = new Range;
            $range->min = $request->input('min');
            $range->max = $request->input('max');
            $range->save();
            $form->range_id = $range->id;
        }
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formcreate == 1) {
                
                $form->save();
                $form->crfs()->sync($request->crfs, false);
        
                if($form->formtype_id == 2 || $form->formtype_id == 3){
        
                    return redirect('/dashboard')->with('go2choice', 'Deine Frage benötigt Auswahlmöglichkeiten! Bitte Auswahlen erstellen!') ; 
                }
                return redirect('/dashboard')->with('success', 'Frage erstellt'); 
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Recht!');
  
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
        $form->unit_id = $request->unit_id;
        $form->format_id = $request->format_id;
        
        if($request->min != null && $request->max != null){
            $range = new Range;
            $range->min = $request->input('min');
            $range->max = $request->input('max');
            $range->save();
            $form->range_id = $range->id;
        }
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formcreate == 1) { 
                                
                $form->save();

                $form->crfs()->sync($request->crfs, false);
      
                if($form->formtype_id == 2 || $form->formtype_id == 3){
                    return redirect()->back()->with('go2choice', 'Deine Frage benötigt Auswahlmöglichkeiten! Bitte Auswahlen erstellen!')->with('success', 'Frage mit Axios erstellt') ; 
                }
                
                return redirect()->back()->with('success', 'Frage mit Axios erstellt');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Recht!');
    }

   
    public function show($id)
    {
        $form = Form::find($id);

        $idtype = $form->formtype_id; 
        $format_id = $form->format_id;
        $unit_id = $form->unit_id;
        $range_id = $form->range_id;

        $aktuellerTyp = Formtype::find($idtype);
        $format = Format::find($format_id);
        $unit = Unit::find($unit_id);
        $range = Range::find($range_id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formshow == 1) {
                return view('forms.show')
                ->with('range', $range)->with('unit', $unit)->with('format', $format)->with('role', $role)->with('form', $form)->with('formtypes', $form->formtypes)->with('choices', $form->choices)->with('aktuellerTyp', $aktuellerTyp); 
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
        
    }

   
    public function edit($id)
    {
        $form = Form::find($id);
        $formtypes = Formtype::all();
        $formats = Format::all();
        $units = Unit::all();
        $crfs = CRF::all();

        $idtype = $form->formtype_id; 
        $format_id = $form->format_id;
        $unit_id = $form->unit_id;
        $range_id = $form->range_id;

        $aktuellerTyp = Formtype::find($idtype);
        $aktuellesFormat = Format::find($format_id);
        $aktuelleUnit = Unit::find($unit_id);
        $aktuellerRange = Range::find($range_id);
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formedit == 1 || auth()->user()->id == $form->user_id) {
                return view('forms.edit')->with('crfs', $crfs)->with('form', $form)->with('formtypes', $formtypes)->withAktuellerTyp($aktuellerTyp)
                ->with('aktuellerRange',$aktuellerRange)->with('formats', $formats)->with('aktuellesFormat', $aktuellesFormat)->with('units', $units)->with('aktuelleUnit', $aktuelleUnit);
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
            'frtext' => 'required',
            'formtype_id' => 'required',

        ]);

        
        //create form
        $form = Form::find($id);
        
        $form->frtext = $request->input('frtext');
        $form->formtype_id = $request->formtype_id;
        $form->unit_id = $request->unit_id;
        $form->format_id = $request->format_id;
        
        if($request->min != null && $request->max != null){
            $range = Range::find($form->range_id);
            $range->min = $request->input('min');
            $range->max = $request->input('max');
            $range->save();
            $form->range_id = $range->id;
        }
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->formcreate == 1) {
                
                $form->save();

                $form->crfs()->sync($request->crfs, true);
      
                if($form->formtype_id == 2 || $form->formtype_id == 3){
                    return redirect('/forms')->with('go2choice', 'Deine Frage benötigt Auswahlmöglichkeiten! Bitte Auswahlen erstellen!') ; 
                }
                
                return redirect('/forms')->with('success', 'Frage aktualisiert');
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Recht!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = Form::find($id);
               
            $role = Role::find(auth()->user()->role_id);

            foreach ($role->rights as $right) {
                if ($right->formedit == 1) {
                    $form -> delete();
                    return redirect('/forms')->with('success', 'Frage erfolgreich gelöscht');
                }
            }
            return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }

    public function destroyAsync($id)
    {
        $form = Form::find($id);
               
            $role = Role::find(auth()->user()->role_id);

            foreach ($role->rights as $right) {
                if ($right->formedit == 1) {
                    $form -> delete();
                    return;
                    // redirect('/forms')->with('success', 'Frage erfolgreich gelöscht')
                }
            }
            return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }

}
