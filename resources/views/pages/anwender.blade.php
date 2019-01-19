@extends('layouts.login-register-template')

@section('content')
@section('title')
{{ config('app.name', 'corticalo') }} | Anwender
@stop
<div class="welcome-cover">
        <div id="" class="hintergrund back"></div>
        <div class="container">
            <div class="jumbocontainer">
                <div class="jumbotron jumbotext">
                    <h1 class="jumbotitle">Mehrwerte für alle Akteure <em>klinischer Studien</em></h1>   
                    <h3 class="lead">Mit <strong>corticalo</strong> bringen Sie ihre klinischen Studien effizient ins Ziel</h3>     
                </div>
                <div class="row justify-content-center">
                    <a href="#user" class="btn btn-lg morebtn"><i class="fa fa-chevron-down"></i></a>
                </div>
            </div>
        </div>   
    </div>
<section class="bg-light" id="user">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12 col-lg-12 m-5 pt-4 pb-5 card">    
                <h2 class="index-text text-center mt-3 mb-3 pt-4">Anwender</h2><br>
                <div class="row">
                   <div class="col-md-4 p-1 mb-3">
                       <h4 class="index-text text-center"><i class="fas fa-pills"></i> Pharmaunternehmen</h4>
                       <p>
                           <ul class="lead pt-2 pb-2 border rounded">
                               <li>
                                    Arzneimittelstudien sind sehr zeit- und kostenintensiv und müssen bei der Durchführen strenge Vorgaben beachten. <br>
                                    <strong>corticalo</strong> unter&shy;stützt <em>Pharma&shy;unter&shy;nehmen</em> bei der Ein&shy;haltung dieser Vor&shy;gaben und sorgt gleichzeit für einen effizienteren klinischen Studien&shy;prozess. Damit schneller Ergeb&shy;nisse erzielt und Maß&shy;nahmen er&shy;griffen werden können. <br>
                               </li>
                           </ul>
                       </p>
                    </div>
                   <div class="col-md-4 p-1 mb-3">
                        <h4 class="index-text text-center"><i class="fas fa-hospital"></i> Klinische Studienzentren</h4>
                        <p>
                            <ul class="lead pt-2 pb-2 border rounded">
                                <li>
                                    <strong>corticalo</strong> unter&shy;stützt privat&shy;wirtschaft&shy;liche oder öffent&shy;lich-recht&shy;liche Studien- und Forschungs&shy;zentren bei ihrer Grund&shy;lagen&shy;forschung sowie ihren anderen Studien- bzw. Forschungs&shy;auf&shy;trägen<br>
                                    Insbesondere bei der Durch&shy;führung multi&shy;zentrischer Studien bietet <strong>corticalo</strong> Optimierungspotenziale, indem alle Akteure über das Studien&shy;management&shy;system zusammen&shy;arbeiten können.
                                </li>
                            </ul>
                        </p>
                    </div>
                   <div class="col-md-4 p-1 mb-3">
                       <h4 class="index-text text-center"><i class="fas fa-user-md"></i> Medizinische Versorger</h4>
                       <p>
                            <ul class="lead pt-2 pb-2 border rounded">
                                <li>
                                    Als Klinik, Medizinisches Ver&shy;sorgungs&shy;zentrum oder Arzt/Ärztin behandeln Sie täglich die unter&shy;schiedlichsten Patienten und ermöglichen ihnen die best&shy;mögliche medi&shy;zinische Ver&shy;sorgung. <br>
                                    <strong>cortcalo</strong> unterstützt medizinische Leistungs&shy;erbringer bei der Durch&shy;führung der klinischen Studien, indem sie diese direkt über die <strong>corticalo</strong>-Plattform abwickeln. <br>
                                    Dadurch wird eine unnötige Papier&shy;doku&shy;menta&shy;tion sowie doppelte Daten&shy;haltung & -archivierung vermieden.
                                </li>
                            </ul>
                        </p>
                    </div>   
                </div>
                <div class="row justify-content-center">
                    <p class="lead alert alert-light">
                        Sie möchten mehr <a href=" {{url('/about')}} " class="alert-link">über uns</a> und unser <a href=" {{url('/funktionen')}} " class="alert-link">Leistungsangebot</a> erfahren oder haben Fragen zur Durchführung ihres Studienprojekts? Dann freuen wir uns über ihre <a href=" {{url('/kontakt')}} " class="alert-link"> Kontaktaufnahme</a>
                    </p>
                </div> 
            </div>
        </div>  
    </div> 
</section>
@endsection