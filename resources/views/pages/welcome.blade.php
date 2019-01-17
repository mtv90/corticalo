@extends('layouts.index-template')

@section('content')
<div class="welcome-cover">
    <div id="particles-js" class="back"></div>
    <div class="container">
        <div class="jumbocontainer">
            <div class="jumbotron jumbotext">
                <h1 class="jumbotitle">Medizin von morgen schon heute erleben</h1>
                <h3 class="jumbosub">mit <b>corticalo</b> effizienter klinische Studien planen, durchführen und auswerten</h3>        
            </div>
        </div>
        <div class="moreBtn">
            <a href="#details" class="corticons"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>   
</div>
<section class="container-fluid bg1 details text-center" id="details">
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
                <h2 class="margin txt2"><strong>Funktionen</strong></h2>
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
    </section>
@endsection

