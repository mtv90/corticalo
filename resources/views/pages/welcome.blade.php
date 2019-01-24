@extends('layouts.index-template')

@section('content')
@section('title')
{{ config('app.name', 'corticalo') }} | klinische Studien planen, erstellen, durchführen und auswerten
@stop
<div class="welcome-cover">
    <div id="particles-js" class="back"></div>
    <div class="container">
        <div class="jumbocontainer">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="jumbotron jumbotext">
                            <h1 class="jumbotitle"><strong>Medizin von morgen schon heute erleben</strong></h1>
                            <h3 class="lead">mit <strong>corticalo</strong> <em>effizienter klinische Studien planen, durchführen und auswerten</em></h3>
                            <hr class="my-4">
                            <p class="row justify-content-md-center">
                                <a title="Über uns und unser Nutzenversprechen" href="{{ url('/about') }}" role="button" class="btn btn-sm btn-outline-dark">mehr erfahren</a>
                            </p>
                        </div> 
                    </div>
                    <div class="carousel-item">
                        <div class="jumbotron jumbotext">
                            <h1 class="jumbotitle"><strong>Mehr Effizienz und Qualität</strong></h1>
                            <h3 class="lead">mithilfe von <strong>corticalo</strong> lassen sich <em>nicht-interventionelle und Arzneimittelstudien</em> sicherer und effizienter gestalten</h3>
                            <hr class="my-4">
                            <p class="row justify-content-md-center">
                                <a title="Funktionen von corticalo" href="{{ url('/funktionen') }}" role="button" class="btn btn-sm btn-outline-dark">mehr erfahren</a>
                            </p>
                        </div> 
                    </div>
                    <div class="carousel-item">
                        <div class="jumbotron jumbotext">
                            <h1 class="jumbotitle"><strong>Pharma&shy;unter&shy;nehmen, klinisches Studien&shy;zentrum, Patienten</strong></h1>
                            <h3 class="lead">von <strong>corticalo</strong> profitieren alle Akteure <em>klinischer Studien</em></h3>
                            <hr class="my-4">
                            <p class="row justify-content-md-center">
                                <a title="Unser Kunden und Anwendungsbereiche" href="{{ url('/anwender') }}" role="button" class="btn btn-sm btn-outline-dark">Wer sind unsere Anwender?</a>
                            </p>
                        </div> 
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div> 
        </div>
    </div>   
</div>

{{-- <section class="container-fluid bg1 details text-center" id="details">
        <h2 class="sectionheading">Detailbereich</h2>
        <div class="row"> 
            <article class="col-md-12 bg1-info sizing">
                <h2 class="margin">Was ist corticalo?</h2>
                <p class="text">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.
                </p>
            </article>
        </div>
        <article class="row">
            <div class="col-md-12">
                <h2 class="margin txt2"><a href="{{ url('/funktionen') }}"><strong>Funktionen</strong></a></h2>
            </div>
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <img src="{{ asset('images/trialtools.jpg') }}" class="img-responsive margin" style="width:100%" alt="Studienplanung">
            </div>
            
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <img src="{{ asset('images/trialtools.jpg') }}" class="img-responsive margin" style="width:100%" alt="Studiendurchführung">
            </div>
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <img src="{{ asset('images/trialtools.jpg') }}" class="img-responsive margin" style="width:100%" alt="Studienauswertung">
            </div>
        </article>
    </section> --}}
@endsection

