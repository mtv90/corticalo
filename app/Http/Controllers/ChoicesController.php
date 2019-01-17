<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\Choice;
use App\Role;
use DB;

class ChoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    public function index()
    {
        $choices = Choice::orderBy('created_at', 'desc')->paginate(5);
        $forms = Form::orderBy('created_at', 'desc')->paginate(5);

        $role = Role::find(auth()->user()->role_id);

        // return $choices;
        foreach ($role->rights as $right) {
            if ($right->choiceindex == 1) {
                return view('choices.index')->with('role', $role)->with('choices', $choices)->with('forms', $forms); 
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');
              
    }

    public function create()
    {
        $forms = Form::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->choicecreate == 1) {
                return view('choices.create')->with('forms', $forms);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');

    }

    public function getform($id)
    {
        $form = Form::find($id);

        return view('getform')->with('form', $form);
    }

    public function store(Request $request)
    {
        $this -> validate($request, [
            'choicestext' => 'required',
            'form_id' => 'required | integer'

        ]);

        //create form
            
        $choice = new Choice;
        $choice->choicestext = $request->input('choicestext');
        $choice->user_id = auth()->user()->id;
        $choice->form_id = $request->form_id;
        

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->choicecreate == 1) {
                $choice->save();

                return redirect('/choices')->with('success', 'Auswahl erstellt');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $choice = Choice::find($id);
        $forms = Form::all();

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->choiceedit == 1 || auth()->user()->id == $choice->user_id) {
                return view('choices.edit')->with('choice', $choice)->with('forms', $forms);
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
            'choicestext' => 'required',
            'form_id' => 'required'

        ]);

        //create form
            
        $choice = Choice::find($id);
        $choice->choicestext = $request->input('choicestext');
        $choice->form_id = $request->form_id;
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->choiceedit == 1) {
                $choice->save();

                return redirect('/choices')->with('success', 'Auswahl aktualisiert');
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
        $choice = Choice::find($id);

        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->choicedelete == 1 || auth()->user()->id == $choice->user_id) {
                $choice -> delete();
                return;
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');            

    }
}
