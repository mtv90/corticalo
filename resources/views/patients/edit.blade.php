@extends('layouts.user-template')

@section('content')
@section('title')
    {{$patient->pavorname}} {{$patient->panachname}}: bearbeiten
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-7 offset-md-2 pt-4 pb-4">
            <h3 class="mb-4">Patient bearbeiten</h3>
            {!! Form::open(['action'=> ['PatientsController@update', $patient->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('vorname', 'Vorname')}}
                    {{Form::text('vorname', $patient->pavorname, ['class'=> 'form-control', 'placeholder' => 'Vorname eingeben'])}}
                </div>
                <div class="form-group">
                    {{Form::label('nachname', 'Nachname')}}
                    {{Form::text('nachname', $patient->panachname, ['class'=> 'form-control', 'placeholder' => 'Nachname eingeben'])}}
                </div>
                <div class="form-group">
                    {{Form::label('geburtsdatum', 'Geburtsdatum')}}
                    {{Form::date('geburtsdatum', $patient->pageburtsdatum, ['class'=> 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('geburtsort', 'Geburtsort')}}
                    {{Form::text('geburtsort', $patient->pageburtsort, ['class'=> 'form-control', 'placeholder' => 'Geburtsort eingeben'])}}
                </div>
                <div class="form-group">
                    {{ Form::label('studies', 'Studien:' ) }}
                    <select  class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="studies[]">
                        @foreach($studies as $study)
                            <option value="{{$study->id}}" 
                                <?php 
                                // hole alle Patienten, die zugeordnet wurden und selektiere sie
                                    foreach ($patient->studies as $patientstudy) {
                                        if($patientstudy->id == $study->id){
                                            echo "selected";
                                            }
                                        }   
                                    ?>
                                    > 
                                {{$study->studyname}} 
                            </option>
                        @endforeach
                    </select>
                </div>
                <a href="/patients" class="btn btn-md cancel-button mb-3 float-right"><span class="fa fa-times"></span> abbrechen</a>
                {{Form::hidden('_method', 'PUT')}}
                <input type="submit" name="submit" value="speichern" class="add-study btn submit-button">    
            {!! Form::close() !!}            
        </div>
    </div>
</section>
@endsection