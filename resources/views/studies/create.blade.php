@extends('layouts.user-template')
@section('content')
@section('title')
    Studie erstellen
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-7 offset-md-2 pt-4 pb-4">
            <a href="/studies" class="btn btn-default border-dark border mb-3">Zurück</a>
            <h3 class="mb-4">Studie erstellen</h3>
            
            {!! Form::open(['action'=> 'StudiesController@showOverview', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{csrf_field()}}
            <div class="form-group">
                {{Form::label('studyname', 'Studienname')}}
                {{Form::text('studyname', '', ['class'=> 'form-control ', 'placeholder' => 'Studienname eingeben', 'required', 'autofocus', 'autocomplete' => 'off'])}}
            </div>
            <div class="form-group">
                {{Form::label('director', 'Studienleiter' , ['class' => ''])}} <br>
                {{Form::text('director', '', ['class'=> 'form-control ', 'placeholder' => 'Studienleiter angeben', 'required' , 'autocomplete' => 'off'])}} 
            </div>
            <div class="form-group">
                {{Form::label('studydescription', 'Studienbeschreibung' , ['class' => ''])}} <br>
                {{Form::textarea('studydescription', '', ['class'=> 'form-control ', 'placeholder' => 'Beschreibung hinzufügen', 'required' , 'autocomplete' => 'off'])}}
            </div>
            <div class="form-group">
                <div class="">
                    <strong> {{ Form::label('crfs', 'CRFs:') }}</strong>
                </div>
                <div class="">
                    <select name="crfs[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                        @foreach($crfs as $crf)
                            <option value=" {{$crf->id}} "> {{$crf->crfName}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if(count($patients) >0 ) 
                <div class="form-group">
                    <div class="">
                        <strong> {{ Form::label('patients', 'Patienten:') }}</strong>
                    </div>
                    <div class="">
                        <select name="patients[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                            @foreach($patients as $patient)
                                <option value=" {{$patient->id}} "> {{$patient->panachname}}, {{$patient->pavorname}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            {{Form::submit('Studie anlegen', ['class' => 'btn submit-button'])}}
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection