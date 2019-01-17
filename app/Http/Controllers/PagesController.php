<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
