@extends('layouts.user-template')

@section('content')
@section('title')
    Fragen: Übersicht
@stop

<section class="content" id="formbody">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        {{-- Zugriffsberechtigung prüfen --}}
                        @foreach ($role->rights as $right)
                            @if ($right->formcreate == 1)
                                {{-- Button öffnet Modal, um Studie anzulegen --}}
                                <button class="btn btn-md create-button float-sm-right float-right" 
                                    data-toggle="modal" data-target="#addModalForm" 
                                    type="button" name="button" >
                                        <span class="fa fa-plus"></span> Erstelle Frage
                                </button>
                            @endif
                        @endforeach

                    </div>
                    <div class="col-md-12">
                        <h2 class="card-text">
                                <span class="fa fa-question"></span> 
                            Erstellte Fragen
                        </h2>
                    </div>
                </div>
            </div>
            @if(count($fragen) > 0)
                @foreach($fragen as $frage )
                <div class="col-md-12 mt-4">
                    <div class="row border rounded m-2 pt-4 pb-4">
                            <div class="col-md-8 ">            
                                <h3>
                                    <a href="/forms/{{$frage->id}}/show" class="index-text">
                                        {{$frage->frtext}}
                                    </a>
                                </h3>
                                <p>
                                    <strong>{{ count($frage->crfs) }}</strong> CRF/s hinzugefügt
                                </p>
                                <small>Erstellt am {{ $frage->created_at }} von <strong>{{$frage->user->vorname}} {{$frage->user->nachname}}</strong></small>
                            </div>
                            {{-- Zugriffsberechtigung prüfen --}}
                            @foreach ($role->rights as $right)
                            @if($right->formedit == 1 || Auth::user()->id == $frage->user_id)
                                <div class="col-md-2">
                                    <a href="/forms/{{$frage->id}}/edit" class="btn btn-default border-dark border">
                                        <span class="fa fa-cogs"></span> Bearbeiten
                                    </a>
                                </div>
                            @endif
                            @endforeach
                            @foreach ($role->rights as $right)
                                @if($right->formdelete == 1 || Auth::user()->id == $frage->user_id)
                                    <div class="col-md-2">
                                        <span class="button-group">
                                            <button data-id="{{$frage->id}}" type="button" name="button" class="delete-form btn btn-danger">
                                                    <span class="fa fa-trash-o"></span> Löschen
                                            </button>
                                        </span>
                                    </div>
                                @endif 
                            @endforeach
                            {{-- --- --}}
                    </div>
                </div>
                @endforeach
                {{$fragen->links()}}
            @else
                <p>Keine Fragen vorhanden</p>
            @endif
        </div>
    </section>

<div class="col-md-12">
    {{-- Modal für Erstellung Frage --}}
    <div class="modal" tabindex="-1" role="dialog" id="addModalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Frage anlegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action'=> 'FormsController@store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                    {{csrf_field()}}
                    <div class="form-group ">
                        {{Form::label('frtext', 'Frage')}}
                        {{Form::text('frtext', '', ['class'=> 'form-control', 'placeholder' => 'Frage eingeben', 'autofocus', 'required'])}}
                    </div>
                    <div class="form-group ">
                        {{Form::label('formtype_id', 'Fragetyp auswählen' , ['class' => ''])}} <br>
                        <select class="form-control" name="formtype_id" required onchange="showFormats(this.value)">
                                <option value="">Fragetyp auswählen...</option>
                            @foreach($formtypess as $formtype)
                                <option value="{{ $formtype->id }}"> {{$formtype->type}} </option>
                            @endforeach
                        </select><br>
                        <div class="form-group" id="showFormat"></div>
                      </div>
                    @if(count($crfs) >0 ) 
                    <div class="form-group">
                        <strong> {{ Form::label('crfs', 'CRFs:') }}</strong>
                        <select name="crfs[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                        @foreach($crfs as $crf)
                            <option value=" {{$crf->id}} "> {{$crf->crfName}} </option>
                        @endforeach
                        </select>
                    </div>
                    @endif
                    
                        {{Form::submit('Frage anlegen', ['class' => 'btn submit-button'])}}
                        {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection