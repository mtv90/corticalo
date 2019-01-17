@extends('layouts.user-template')

@section('content')
@section('title')
    Patient erstellen
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-7 offset-md-2 pt-4 pb-4">
            <h3 class="mb-4">Patient erstellen</h3>
            {!! Form::open(['action'=> 'PatientsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('vorname', 'Vorname')}}
                    {{Form::text('vorname', '', ['class'=> 'form-control', 'placeholder' => 'Vorname eingeben', 'autofocus', 'autocomplete' => 'off', 'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('nachname', 'Nachname')}}
                    {{Form::text('nachname', '', ['class'=> 'form-control', 'placeholder' => 'Nachname eingeben', 'autocomplete' => 'off', 'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('geburtsdatum', 'Geburtsdatum')}}
                    {{Form::date('geburtsdatum', '', ['class'=> 'form-control', 'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('geburtsort', 'Geburtsort')}}
                    {{Form::text('geburtsort', '', ['class'=> 'form-control', 'placeholder' => 'Geburtsort eingeben',  'autocomplete' => 'off', 'required'])}}
                </div>
                <div class="form-group">
                    <label for="studies">Studie auswählen:</label>
                    @if(count($studies)>0)
                        <select name="studies[]" class="js-example-basic-multiple" multiple style="width:100%">
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
                {{Form::submit('Patient anlegen', ['class' => 'btn submit-button'])}}
            {!! Form::close() !!}
        </div>
    </div>
</section>

@endsection