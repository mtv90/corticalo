@extends('layouts.user-template')

@section('content')
@section('title')
    {{$study->studyname}}: bearbeiten
@stop
<section class="content">
    <div class="container-fluid">
        
        <div class="col-md-7 offset-md-2 pt-4 pb-4">
                <h2 class="mb-4">Studie bearbeiten</h2>
                {!! Form::open(['action'=> ['StudiesController@update', $study->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('studyname', 'Studienname')}}
                    {{Form::text('studyname', $study->studyname, ['class'=> 'form-control ', 'placeholder' => 'Studienname eingeben'])}}
                </div>
                <div class="form-group">
                    {{Form::label('director', 'Studienleiter' , ['class' => ''])}} <br>
                    {{Form::text('director', $study->director , ['class'=> 'form-control ', 'placeholder' => 'Studienleiter angeben'])}}
                </div>
                <div class="form-group">
                    {{Form::label('studydescription', 'Studienbeschreibung' , ['class' => ''])}} <br>
                    {{Form::textarea('studydescription', $study->studydescription, ['class'=> 'form-control ', 'placeholder' => 'Beschreibung hinzufügen'])}}
                </div>
                
                <div class="form-group">
                    {{ Form::label('crfs', 'CRFs:' ) }}
                    <select class="js-example-basic-multiple" name="crfs[]" id="crfs" multiple style="width:100%">
                            @foreach($crfs as $crf)
                                <option value="{{$crf->id}}" 
                                    <?php 
                                        // hole alle CRFs, die zugeordnet wurden und selektiere sie
                                        foreach ($study->crfs as $studycrf) {
                                            if($studycrf->id == $crf->id){
                                                echo "selected";
                                            }
                                        }   
                                    ?>
                                    > {{$crf->crfName}} </option>
                            @endforeach
                        </select>
             
                </div>
                <div class="form-group">
                    {{ Form::label('patients', 'Patienten:' ) }}
                    <select class="js-example-basic-multiple" name="patients[]" id="patients" multiple style="width:100%">
                        @foreach($patients as $patient)
                        <option value="{{$patient->id}}" 
                            <?php 
                            // hole alle Patienten, die zugeordnet wurden und selektiere sie
                                foreach ($study->patients as $studypatient) {
                                    if($studypatient->id == $patient->id){
                                        echo "selected";
                                    }
                                }   
                            ?>
                        > {{$patient->panachname}}, {{$patient->pavorname}} </option>
                        @endforeach
                    </select>
                </div>
            
                <a href="/studies" class="btn btn-md cancel-button mb-3 float-right"><span class="fa fa-times"></span> abbrechen</a>
                {{Form::hidden('_method', 'PUT')}}
                
                    <input type="submit" name="submit" value="speichern" class="add-study btn submit-button">
                {!! Form::close() !!}
                
            </div>
    </div>
</section>
@endsection

