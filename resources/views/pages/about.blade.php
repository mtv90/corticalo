@extends('layouts.login-register-template')

@section('content')
@section('title')
{{ config('app.name', 'corticalo') }} | Über uns
@stop
<div class="welcome-cover">
        <div id="" class="hintergrund back"></div>
        <div class="container">
            <div class="jumbocontainer">
                <div class="jumbotron jumbotext">
                <h1 class="jumbotitle text-center"><em>Medizin</em> von morgen zum Greifen nah!</h1>   
                    <h3 class="lead">Wir bringen alle Beteiligten <em>klinischer Studien</em> enger zusammen, vereinfachen ihre Arbeitsprozesse und beschleunigen damit den medizinischen Fortschritt</h3>     
                </div>
                <div class="row justify-content-center">
                    <a href="#aboutus" class="btn btn-lg morebtn"><i class="fa fa-chevron-down"></i></a>
                </div>
            </div>
        </div>   
    </div>
<section class="bg-light" id="aboutus">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12 col-lg-12 m-5 pt-4 pb-5 card">    
                <h2 class="index-text text-center m-3 pt-4">Über <strong>corticalo</strong></h2><br>
                <p class="lead">
                    Wir sorgen dafür, dass sich unsere Kunden auf das Wesentliche konzentrieren können: <em>den klinischen Studienprozess und die Patienten!</em><br>
                </p>
                <p class="lead">
                    <strong>corticalo</strong> ist eine Plattform, mit der sich klinische Studien vollständig digital abbilden lassen - von der <em>Studienplanung</em> und der Wahl des <em>Studiendesigns</em>, über die <em>Erstellung und Verwaltung von klinischen Prüfbögen (sogenannte Case Report Forms bzw. eCRF)</em> bis zur <em>zentralen und sicheren Datensicherung</em> sowie <em>intuitiven und visuellen Datenauswertung</em>. 
                </p>
                <p class="lead">
                    Damit wollen wir Ihnen eine aufwendige Papierdokumentation und doppelte Datenhaltung ersparen. Gleizeitig ermöglicht <strong>corticalo</strong> Ihnen eine effizientere Datenhaltung bzw. Datenverfügbarkeit: da Ihre erfassten Daten zentral bei uns gesichert werden, hat jeder beteiligte und authorisierte Akteuer sofort Zugriff auf die Daten. Das spart Zeit und optimiert den klinischen Studienprozess. Des Weiteren können Sie mit verschiedensten Datenanalysemethoden ihre Daten effizient aufbereiten und visualisieren und somit schneller die richtigen Erkenntnisse gewinnen.
                </p>
                <p class="lead">
                    Außerdem untersützt Sie <strong>corticalo</strong> bei der <em>Termin- und Ressourcenplanung</em> sowie <em>Konsistenz- und Vollständigkeitsprüfung der Daten</em>. Insgesamt wollen wir dadurch die <em>Effizienz der Organisation und Durchführung von klinischen Studien steigern</em> und mithilfe von neuesten Technologien für eine höhere Datenqualität sorgen. Natürlich ist uns der Schutz und die Sicherheit Ihrer Daten äußerst wichtig, weshalb wir nicht nur die einschlägigen gesetzlichen Vorgaben berücksichtigen, sondern auch mit spezialisierten Anbietern und Institutionen im Bereich Datenschutz bzw. Datensicherheit zusammenarbeiten.
                </p>
                <p class="lead">
                    Genauere Informationen zu den Funktionen von <strong>corticalo</strong> finden <a href=" {{url('/funktionen')}} " class="alert-link">hier</a>
                </p>
            </div> 
        </div>
    </div> 
</section>
@endsection