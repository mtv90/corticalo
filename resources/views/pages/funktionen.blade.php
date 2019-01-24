@extends('layouts.login-register-template')

@section('content')
@section('title')
{{ config('app.name', 'corticalo') }} | Funktionen
@stop
<div class="welcome-cover">
        <div id="" class="hintergrund back"></div>
        <div class="container">
            <div class="jumbocontainer">
                <div class="jumbotron jumbotext">
                    <h1 class="jumbotitle">Klinische Studien sind komplex</h1>   
                    <h3 class="lead">um Ihnen gerecht zu werden, bietet <strong>corticalo</strong> umfangreiche <a href="#function" class="morebtn">Funktionen</a></h3>     
                </div>
                <div class="row justify-content-center">
                    <a href="#function" class="btn btn-lg morebtn"><i class="fa fa-chevron-down"></i></a>
                </div>
            </div>
        </div>   
    </div>
<section class="bg-light" id="function">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12 col-lg-12 m-5 pt-4 pb-5 card">    
                <h2 class="index-text text-center mt-3 mb-3 pt-4">Funktionen</h2><br>
                <div class="row">
                    <div class="col-md-4 p-1 mb-3">
                        <h4 class="index-text text-center"> <i class="fa fa-sitemap "></i> Organisation</h4>
                        <p>
                            <ul class="lead pt-2 pb-2 border rounded">
                                <li><i class="fas fa-check check-icon"></i> Studien erstellen:
                                    <p><small>
                                        Fest&shy;legen von Rahmen&shy;bedingungen (Zeit, Budget etc.) <br> <hr>
                                        Aus&shy;wahl des Studien&shy;designs <br> <hr>
                                        Er&shy;stellung von Case Report Forms (eCRF) <br> <hr>
                                        Defi&shy;nition von Vor&shy;gaben (Pflicht&shy;felder, Eingabe&shy;typ z.B Text oder Zahl, Werte&shy;bereich) <hr>
                                        </small>
                                    </p>
                                </li> <hr>
                                <li><i class="fas fa-check check-icon"></i> Studien-Teams verwalten:
                                    <p>
                                        <small>
                                            Verwaltung von Studien-Teams und Stand&shy;orten <br> <hr>
                                            Benutzer&shy;rechte-Verwaltung der Team&shy;mitglieder <br> <hr>
                                        </small>
                                    </p>
                                </li><hr>
                                <li><i class="fas fa-check check-icon"></i> Termin- & Ressourcenplanung</li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-4 p-1 mb-3">
                        <h4 class="index-text text-center"><i class="fas fa-tasks"></i> Durchführung</h4>
                        <p>
                            <ul class="lead pt-2 pb-2 border rounded">
                                <li><i class="fas fa-check check-icon"></i> Bereit&shy;stellen von Studien:
                                    <p>
                                        <small>
                                            Studien&shy;teilnehmer zu Studien einladen & informieren <br> <hr>
                                            Patienten verwalten <br> <hr>
                                            Durch&shy;führung der Doku&shy;mentation über eCRF <br> <hr>
                                            Benach&shy;richti&shy;gungs&shy;funktion, Voll&shy;ständigkeits -& Konsistenzprüfung <hr>
                                        </small>
                                    </p>
                                </li><hr>
                                <li><i class="fas fa-check check-icon"></i> Studien&shy;versions&shy;kontrolle:
                                    <p>
                                        <small>
                                            Audit-Trail: Ver&shy;laufs&shy;doku&shy;menta&shy;tion von er&shy;stellten, geänderten oder gelöschten elek&shy;tronischen Auf&shy;zeichnungen <br><hr>
                                        </small>
                                    </p>
                                </li><hr>
                                <li><i class="fas fa-check check-icon"></i> Export von eCRF's:
                                    <p>
                                        <small>
                                            Export von Prüf&shy;bögen und sonstigen Doku&shy;menten in gängige Formate (xls, pdf, csv etc.)
                                        </small>
                                    </p>
                                </li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-4 p-1 mb-3">
                        <h4 class="index-text text-center"><i class="far fa-chart-bar"></i> Analyse</h4>
                        <p>
                            <ul class="lead pt-2 pb-2 border rounded">
                                <li><i class="fas fa-check check-icon"></i> Erstellung von Reports:
                                    <p>
                                        <small>
                                            Erstellung von indi&shy;viduellen Berichten <br><hr>
                                        </small>
                                    </p>
                                </li><hr>
                                <li><i class="fas fa-check check-icon"></i> Daten&shy;auswertung:
                                    <p>
                                        <small>
                                            Wahl ver&shy;schiedener Daten&shy;ana&shy;lyse&shy;methoden (qualitativ, quantitativ)<br><hr>
                                            Regressions&shy;analyse, Assoziations&shy;analyse, Cluster&shy;analyse, Klassifikation <br> <hr>
                                        </small>
                                    </p>
                                </li><hr>
                                <li><i class="fas fa-check check-icon"></i> Daten&shy;visualisierung:
                                    <p>
                                        <small>
                                            Voraus&shy;wahl aus verschiedene Tabellen- & Diagramm&shy;vorlagen <br> <hr>
                                            Individuelle Dar&shy;stellungs&shy;möglichkeit <br>
                                        </small>
                                    </p>
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <p class="lead alert alert-light">
                        Sie möchten mehr <a href=" {{url('/about')}} " class="alert-link">über uns</a> und unser Lei&shy;stungs&shy;angebot oder <a href=" {{url('/anwender')}} " class="alert-link">An&shy;wendungs&shy;gebiete</a> erfahren? Dann freuen wir uns über ihre <a href=" {{url('/kontakt')}} " class="alert-link"> Kontakt&shy;aufnahme</a>
                    </p>
                </div>
            </div> 
        </div>  
    </div> 
</section>
@endsection