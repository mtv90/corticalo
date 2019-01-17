@extends('layouts.user-template')

@section('content')
@section('title')
    Studien: Übersicht
@stop
<section class="content">
    <div class="container-fluid pb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mt-4">
                    {{-- Button öffnet Modal, um Studie anzulegen --}}
                    @foreach ($role->rights as $right)
                        @if ($right->studicreate == 1)
                            <button class="btn btn-md create-button float-sm-right float-right" 
                                data-toggle="modal" data-target="#addModalStudy" 
                                type="button" name="button" >
                                    <span class="fa fa-plus"></span> Erstelle Studie
                            </button>
                        @endif   
                    @endforeach
                </div>
                <div class="col-md-12">
                    <h2 class="card-text">
                        <span class="fa fa-book"></span> 
                        Erstellte Studien
                    </h2>
                </div>
            </div>
        </div>
        @if(count($studies) > 0)
            @foreach($studies as $study )
            <div class="col-md-12 mt-4">
                <div class="row border rounded m-2 pt-4 pb-4">
                        <div class="col-md-8 ">            
                            <h3>
                                <a href="/studies/{{$study->id}}" class="index-text">
                                    {{$study->studyname}}
                                </a>
                            </h3>
                            <p>
                                <strong>{{ count($study->crfs) }}</strong> CRF/s hinzugefügt
                            </p>
                        <small>Erstellt am {{$study->created_at}} von <strong>{{$study->user->vorname}} {{$study->user->nachname}}</strong></small>
                        </div>
                        {{-- @if(Auth::user()->id == $study->user_id) --}}
                        @foreach($role->rights as $right)
                            @if($right->studiedit == 1)
                                <div class="col-md-2">
                                    <a href="/studies/{{$study->id}}/edit" class="btn btn-default border-dark border">
                                        <span class="fa fa-cogs"></span> Bearbeiten
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        @foreach($role->rights as $right)
                            @if($right->studidelete == 1)
                                <div class="col-md-2">
                                    <span class="button-group">
                                        <button data-id="{{$study->id}}" type="button" name="button" class="delete-study btn btn-danger">
                                                <span class="fa fa-trash-o"></span> Löschen
                                        </button>
                                    </span>
                                </div>
                            @endif
                        @endforeach  
                </div>
            </div>
            @endforeach
        {{$studies->links()}}
        @else
            <p>Keine Studien gefunden</p>
        @endif
    </div>
</section>

<div class="col-md-12">
      {{-- Modal für Erstellung Studie --}}
    <div class="modal" tabindex="-1" role="dialog" id="addModalStudy">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Studie anlegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action'=> 'StudiesController@showOverview', 'method' => 'POST']) !!}
                    {{csrf_field()}}
                        <div class="form-group">
                            {{Form::label('studyname', 'Studienname')}}
                            {{Form::text('studyname', '', ['class'=> 'form-control', 'placeholder' => 'Studienname eingeben', 'autofocus', 'autocomplete' => 'off'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('director', 'Studienleiter' , ['class' => ''])}} <br>
                            {{Form::text('director', '', ['class'=> 'form-control', 'placeholder' => 'Studienleiter angeben', 'autocomplete' => 'off'])}} 
                        </div>
                        <div class="form-group">
                            {{Form::label('studydescription', 'Studienbeschreibung' , ['class' => ''])}} <br>
                            {{Form::textarea('studydescription', '', ['class'=> 'form-control', 'placeholder' => 'Beschreibung hinzufügen'])}}
                        </div>
                        @if(count($crfs) >0 ) 
                        <div class="form-group">
                            <strong> {{ Form::label('crfs', 'CRFs:') }}</strong>
                            <select name="crfs[]" class="form-control" multiple="multiple" >
                            @foreach($crfs as $crf)
                                <option value=" {{$crf->id}} "> {{$crf->crfName}} </option>
                            @endforeach
                            </select>
                        </div>
                        @endif
                        @if(count($patients) >0 ) 
                        <div class="form-group">
                            <strong> {{ Form::label('patients', 'Patienten:') }}</strong>
                            <select name="patients[]" class="form-control" multiple="multiple" >
                            @foreach($patients as $patient)
                                <option value=" {{$patient->id}} "> {{$patient->panachname}}, {{$patient->pavorname}} </option>
                            @endforeach
                            </select>
                        </div>
                        @endif
                    <div class="">
                        {{Form::submit('Studie anlegen', ['class' => 'btn submit-button'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection