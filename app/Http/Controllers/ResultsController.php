<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Result;
use App\Formtype;
use App\Form;
use App\CRF;
use App\Study;
use App\Textresult;
use App\Textarearesult;
use App\Dateresult;
use App\Doubleresult;
use App\Integerresult;
use App\Yearresult;
use App\Timeresult;
use App\Role;
use DB;

class ResultsController extends Controller
{
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
        $results = DB::table('results')
                ->join('patient', 'results.patient_id', '=', 'patient.id')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->join('crfs', 'results.crf_id', '=', 'crfs.id')
                ->select('patient.panachname', 'patient.pavorname', 'users.vorname', 'users.nachname', 'results.*', 'crfs.crfName')
                ->orderBy('created_at', 'desc')->paginate(5);
        $crfs = CRF::all();
        $studies = Study::all();
        $allresults = Result::all();
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->resultindex == 1) {
                return view('answers.index')->with('allresults', $allresults)->with('results', $results)->with('studies', $studies)->with('role', $role);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this -> validate($request, [
            'study_id' => 'required',
            'crf_id' => 'required',
            'study_id' => 'required',
        ]);

        $study = Study::find($request->study_id);
        $crf = CRF::find($request->crf_id);
        $patients = auth()->user()->patients;
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->resultcreate == 1) {
                return view('answers.create')->with('crf', $crf)->with('forms', $crf->forms)->with('patients', $patients)->with('study', $study);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }

    
    public function store(Request $request)
    {
        $this -> validate($request, [
            'crf_id' => 'required',
            'patient_id' => 'required',
            'study_id' => 'required',

        ]);
        $result = new Result;

        $result->user_id = auth()->user()->id;
        $result->crf_id = $request->crf_id;
        $result->study_id = $request->study_id;
        $result->patient_id = $request->patient_id;
        $result->save();

        //Texteingaben auslesen und speichern
        if($request->answertexts != null){
            foreach ($request->answertexts as $frage=>$antwortarray) {
                
                $text = new Textresult;
                $text->form_id = $frage;
                $text->result_id = $result->id;
                foreach($antwortarray as $antwort){
                    $text->answertext = $antwort;
                }
                
                $text->save();
            } 
        }
        //Freitext auslesen und speichern
        if($request->answertextareas != null) {
            foreach ($request->answertextareas as $frage=>$antwortarray) {
                $textarea = new Textarearesult;
                $textarea->form_id = $frage;
                $textarea->result_id = $result->id;
                foreach($antwortarray as $antwort){
                    $textarea->answertextarea = $antwort;
                }
                // return $textarea;
                $textarea->save();
            }
        }    
        //Datum auslesen und speichern
        if($request->answerdates != null) {
            foreach ($request->answerdates as $frage=>$antwortarray) {
                $date = new Dateresult;
                $date->form_id = $frage;
                $date->result_id = $result->id;
                foreach($antwortarray as $antwort){
                    $date->answerdate = $antwort;
                }
                $date->save();
            }
        }  
        //Datum auslesen und speichern
        if($request->answertimes != null) {
            foreach ($request->answertimes as $frage=>$antwortarray) {
                $time = new Timeresult;
                $time->form_id = $frage;
                $time->result_id = $result->id;
                foreach($antwortarray as $antwort){
                    $time->answertime = $antwort;
                }
                $time->save();
            }
        } 
        //Jahr auslesen und speichern
        if($request->answeryears != null) {
            foreach ($request->answeryears as $frage=>$antwortarray) {
                $year = new Yearresult;
                $year->form_id = $frage;
                $year->result_id = $result->id;
                foreach($antwortarray as $antwort){
                    $year->answeryear = $antwort;
                }
                $year->save();
            }
        } 
        //Ganzzahl auslesen und speichern
        if($request->answerintegers != null) {
            
            foreach ($request->answerintegers as $frage => $antwortarray) {

                $integer = new Integerresult;
                $integer->form_id = $frage;
                $integer->result_id = $result->id;
                foreach($antwortarray as $antwort)
                {
                    $integer->answerinteger = $antwort;
                }
                
                
                $integer->save();
            }
        } 
        //Gleitkommazahl auslesen und speichern
        if($request->answerdoubles != null) {

            foreach($request->answerdoubles as $frage => $antwortarray){

                $double = new Doubleresult;
                $double->form_id = $frage;
                $double->result_id = $result->id;
                foreach($antwortarray as $antwort)
                {
                    $double->answerdouble = $antwort;
                }
                $double->save();
            }

        }
        $result->forms()->sync($request->forms, false);
        $result->choices()->sync($request->check, false);
        $result->choices()->sync($request->radio, false);

        
        return redirect('/answers')->with('success', 'CRF beantwortet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
                return view('answers.show')
                    ->with('role', $role)
                    ->with('crf', $crf)
                    ->with('forms', $result->forms)
                    ->with('patient', $patient)
                    ->with('result', $result);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }

    public function edit($id)
    {
        $result = Result::find($id);
        $patient = Patient::find($result->patient_id);
        $crf = CRF::find($result->crf_id);
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->resultedit == 1 || auth()->user()->id == $result->user_id) {
                return view('answers.edit')
                ->with('doubleresults', $result->doubleresults)
                ->with('integerresults', $result->integerresults)
                ->with('timeresults', $result->timeresults)
                ->with('yearresults', $result->yearresults)
                ->with('dateresults', $result->dateresults)
                ->with('textresults', $result->textresults)
                ->with('textarearesults', $result->textarearesults)
                ->with('crf', $crf)->with('forms', $crf->forms)->with('patient', $patient)->with('result', $result);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
    }


    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'crf_id' => 'required',
            'patient_id' => 'required',

        ]);

        // hole bearbeiteten CRF und überschreibe die Daten
        $result = Result::find($id);
        $result->user_id = auth()->user()->id;
        $result->crf_id = $request->crf_id;
        $result->patient_id = $request->patient_id;
        $result->save();

        // Textergebnisse auslesen und speichern
        if($request->answertexts !== null){
           foreach($result->textresults as $textresult){
                foreach ($request->answertexts as $frage=>$antwortarray) {
                    if($textresult->form_id == $frage){
                        $text = Textresult::find($textresult->id);
                        $text->form_id = $frage;
                        $text->result_id = $result->id;
                        foreach($antwortarray as $antwort){
                            $text->answertext = $antwort;
                        }
                        $text->save();
                    }
                }
            } 
        }
        // Ende Textfeldänderungen
        
        // Textarea-Änderungen auslesen und speichern
            if($request->answertextareas !== null) {
                foreach($result->textarearesults as $arearesult){
                    foreach ($request->answertextareas as $frage=>$antwortarray) {
                        if($arearesult->form_id == $frage){
                            $area = Textarearesult::find($arearesult->id);
                            $area->form_id = $frage;
                            $area->result_id = $result->id;
                            foreach($antwortarray as $antwort){
                                $area->answertextarea = $antwort;
                            }
                            $area->save();
                        }
                    }
                }
            }

        // Ende TextareaÄnderung

        //Datumsänderung auslesen und speichern
        if($request->answerdates !== null){
            foreach($result->dateresults as $dateresult){
                foreach($request->answerdates as $frage=>$antwortarray){
                    if($dateresult->form_id == $frage){
                        $date = Dateresult::find($dateresult->id);
                        $date->form_id = $frage;
                        $date->result_id = $result->id;
                        foreach($antwortarray as $antwort){
                            $date->answerdate = $antwort;
                            
                        }
                        $date->save();
                    }
                }
            }
        }
        // Ende Datumsänderung

        //Zeitänderungen aktualisieren
        if($request->answertimes !== null){
            foreach($result->timeresults as $timeresult){
                foreach($request->answertimes as $frage=>$antwortarray){
                    if($timeresult->form_id == $frage){
                        $time = Timeresult::find($timeresult->id);
                        $time->form_id = $frage;
                        $time->result_id = $result->id;
                        foreach($antwortarray as $antwort){
                            $time->answertime = $antwort;
                            
                        }
                        // return $time;
                        $time->save();
                    }
                }
            }
        }
        ///Ende Zeitänderungen
        
        // Änderung der Jahreszahl
        if($request->answeryears !== null){
            foreach($result->yearresults as $yearresult){
                foreach($request->answeryears as $frage=>$antwortarray){
                    if($yearresult->form_id == $frage){
                        $year = Yearresult::find($yearresult->id);
                        $year->form_id = $frage;
                        $year->result_id = $result->id;
                        foreach($antwortarray as $antwort){
                            $year->answeryear = $antwort;
                            
                        }
                        // return $time;
                        $year->save();
                    }
                }
            }
        }
        // Ende Jahreszahländerung
        
        //Ganzzahl auslesen und speichern
        if($request->answerintegers != null) {
            foreach($result->integerresults as $integerresult){
                foreach ($request->answerintegers as $frage => $antwortarray) {
                    if($integerresult->form_id == $frage){
                        $integer = Integerresult::find($integerresult->id);
                        $integer->form_id = $frage;
                        $integer->result_id = $result->id;
                        foreach($antwortarray as $antwort)
                        {
                            $integer->answerinteger = $antwort;
                        }
                        $integer->save();
                    }
                }
            } 
        }
        // Ende Ganzzahländerung

        //Gleitkommazahl auslesen und speichern
        if($request->answerdoubles != null) {
            foreach($result->doubleresults as $doubleresult){
                foreach($request->answerdoubles as $frage => $antwortarray){
                    if($doubleresult->form_id == $frage){
                        $double = Doubleresult::find($doubleresult->id);                    
                        $double->form_id = $frage;
                        $double->result_id = $result->id;
                        foreach($antwortarray as $antwort)
                        {
                            $double->answerdouble = $antwort;
                        }
                        $double->save();
                    }
                }    
            }
        }
        // Ende Gleitkommazahländerung

        $result->forms()->sync($request->forms, true);
        $result->choices()->sync($request->choices, true);
        // $result->choices()->sync($request->radio, true);

        return redirect('/answers')->with('success', 'Antwort bearbeitet');
    }

    public function confirmDelete(Request $request){
        
        // return $request;
        // $value = $request->session()->put('result_id', $request->resultID);
        $data = $request->session()->get('_previous');
        $val;
        foreach ($data as $key => $value) {
            $val = $value;
        }
        return view('answers.confirm')->with('val', $val);
    }
    
    public function destroy(Request $request)
    {
        $data = $request->session()->pull('result_id');
        
        $result = Result::find($data);

        $role = Role::find(auth()->user()->role_id);
        
        foreach ($role->rights as $right) {
            if ($right->resultdelete == 1 && auth()->user()->id == $result->user_id) {
                
                foreach($result->textresults as $text){
                    $text -> delete();
                }
                foreach($result->textarearesults as $area){
                    $area -> delete();
                }
                foreach($result->dateresults as $date){
                    $date -> delete();
                }
                foreach($result->timeresults as $time){
                    $time -> delete();
                }
                foreach($result->yearresults as $year){
                    $year -> delete();
                }
                foreach($result->integerresults as $integer){
                    $integer -> delete();
                }
                foreach($result->doubleresults as $double){
                    $double -> delete();
                }
                $result -> delete();
                return redirect('/answers')->with('success', 'Antwort wurde gelöscht');            
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');

    }


}
