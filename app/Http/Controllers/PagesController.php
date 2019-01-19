<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kontakt;

class PagesController extends Controller
{
    public function welcome(){
        return view('pages.welcome');
    }

    public function impressum(){
        return view('pages.impressum');
    }

    public function datenschutz(){
        return view('pages.datenschutz');
    }

    public function anwender(){
        return view('pages.anwender');
    }

    public function funktionen(){
        return view('pages.funktionen');
    }

    public function kontakt(){
        return view('pages.kontakt');
    }

    public function about(){
        return view('pages.about');
    }

    public function storeKontakt(Request $request){

        $this -> validate($request, [
            'vorname' => 'required',
            'nachname' => 'required',
            'email' => 'required',
            'betreff' => 'required',
            'message' => 'required',
        ]);
        
        $kontakt = new Kontakt;
        $kontakt->vorname = $request->input('vorname');
        $kontakt->nachname = $request->input('nachname');
        $kontakt->email = $request->input('email');
        $kontakt->betreff = $request->input('betreff');
        $kontakt->message = $request->input('message');
        
        if($request->input('telefon') !== null){
            $kontakt->telefon = $request->input('telefon');
        }
        // $kontak->save();
        return redirect('/kontakt')->with('send', 'Wir haben Ihre Nachricht erhalten und melden uns umgehend zurück!');
    }
}
