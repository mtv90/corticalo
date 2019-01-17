@extends('layouts.user-template')

@section('content')
@section('title')
    Patienten: Übersicht
@stop
<section class="content">
        <div class="container-fluid pb-4">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        {{-- Zugriffsrecht überprüfen --}}
                        @foreach ($role->rights as $right)
                            @if ($right->patcreate)
                                {{-- Button öffnet Modal, um Studie anzulegen --}}
                                <button class="btn btn-md create-button float-sm-right float-right" 
                                    data-toggle="modal" data-target="#addModalPatient" 
                                    type="button" name="button" >
                                        <span class="fa fa-plus"></span> Erstelle Patienten
                                </button>
                            @endif
                        @endforeach
                        {{-- --- --}}
                    </div>
                    <div class="col-md-12">
                        <h2 class="card-text">
                            <span class="fa fa-address-book"></span> 
                            Erstellte Patienten
                        </h2>
                    </div> 
                </div>
                @if (count($patients) > 0)
                    @foreach ($patients as $patient)
                        <div class="col-md-12 mt-4">
                            <div class="row border rounded m-2 pt-4 pb-4">
                                <div class="col-md-6">
                                    <h3>
                                        <a href="/patients/{{$patient->id}}" class="index-text">
                                            {{$patient->pavorname}} {{$patient->panachname}}
                                        </a>
                                    </h3>
                                    <small>Geboren am {{$patient->pageburtsdatum}}</small>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                    {{$patients->links()}} 
                @else
                    <p>Keine Patienten gefunden</p> 
                @endif
            </div>
        </div>
</section>

<div class="col-md-12">

      {{-- Modal für Erstellung Auswahl --}}
      <div class="modal" tabindex="-1" role="dialog" id="addModalPatient">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Patienten anlegen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    {!! Form::open(['action'=> 'PatientsController@store', 'method' => 'POST']) !!}
                        {{csrf_field()}}
                        <div class="form-group">
                                {{Form::label('vorname', 'Vorname')}}
                                {{Form::text('vorname', '', ['class'=> 'form-control', 'placeholder' => 'Vorname eingeben', 'autofocus', 'required', 'autocomplete' => 'off'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('nachname', 'Nachname')}}
                                {{Form::text('nachname', '', ['class'=> 'form-control', 'placeholder' => 'Nachname eingeben', 'required', 'autocomplete' => 'off'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('geburtsdatum', 'Geburtsdatum')}}
                                {{Form::date('geburtsdatum', '', ['class'=> 'form-control', 'required'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('geburtsort', 'Geburtsort')}}
                                {{Form::text('geburtsort', '', ['class'=> 'form-control', 'placeholder' => 'Geburtsort eingeben', 'required', 'autocomplete' => 'off'])}}
                            </div>
                            <div class="form-group">
                                    <label for="study_id">Studie auswählen:</label>
                                    @if(count($studies)>0)
                                        <select name="studies[]"  class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                                            @foreach($studies as $study)        
                                                <option value="{{$study->id}}">{{$study->studyname}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="alert alert-warning">
                                            <strong>Keine Studien vorhanden!</strong>
                                        </div>
                                    @endif
                            </div>
                            {{-- class="col-md-12 alert border rounded shadow" --}}
                        {{Form::submit('Auswahl anlegen', ['class' => 'btn submit-button'])}}
                    {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection