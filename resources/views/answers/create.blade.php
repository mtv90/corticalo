@extends('layouts.user-template')

@section('content')
@section('title')
    Befragung durchführen
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-9 offset-md-1 pt-4 pb-4">
            <a href="/answers" class="btn btn-default border-dark border mb-3">abbrechen</a>
                
            {{-- Beginn Formular zum Beantworten des Fragebogens
                Es wird zum Speichern die store-Methode im ResultsController ausgeführt
                Die Inhalte werden per POST gespeichert --}}
                    
            {!! Form::open(['action'=> 'ResultsController@store', 'method' => 'POST']) !!}
                <div class="row alert alert-light border rounded col-md-12">
                    <div class="col-md-6">
                        <label for="study_id">Studie:</label> 
                        <select name="study_id" id="study_id" class="col-md-12 alert border rounded">
                            <option value="{{$study->id}}">#{{$study->id}} <strong>{{$study->studyname}}</strong></option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="crf_id">CRF:</label> 
                        <select name="crf_id" id="crf_id" class="col-md-12 alert border rounded">
                            <option value="{{$crf->id}}">#{{$crf->id}} <strong>{{$crf->crfName}}</strong></option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="patient_id">
                            <strong>3. Patienten angeben:</strong>
                        </label>
                        @if(count($patients)>0)
                            <select id="patient_id" name="patient_id" class="col-md-12 alert border rounded" required>
                                <option value="">Wähle einen Patienten..</option>
                                @foreach($study->patients as $patient)        
                                    <option value="{{$patient->id}}">{{$patient->panachname}},{{$patient->pavorname}}</option>
                                @endforeach
                            </select>
                        @else
                            <div class="alert alert-warning">
                                <strong>Beantwortung nicht möglich!</strong> Es sind keine <strong>Patienten</strong> zuordenbar!
                            </div>
                        @endif
                    </div>
                
                   {{-- Lösung, damit auch eine Zuordnung in Tabelle form_result möglich ist --}}
                    <select name="forms[]"  multiple="multiple" hidden>
                        @foreach($crf->forms as $form)
                            <option value=" {{$form->id}} " selected> {{$form->frtext}} </option>
                        @endforeach
                    </select>        
                            
                    <div class="col-md-12">   
                    {{-- Beginn der Beantwortung der Fragen!!! --}}
                        @if(count($crf->forms)>0)
                            @foreach($crf->forms as $form)
                                <div class="alert border">
                                    <strong>
                                        <label id="{{$form->id}}" >{{ $form->frtext }} </label> 
                                    </strong>
                                    <br>
                                    @if ($form->formtype_id == 1)
                                        @switch($form->format_id)
                                        @case(1)
                                            <input name="answertexts[{{$form->id}}][]" type="text" class="form-control shadow">
                                            @break
                                        @case(2)
                                            <textarea name="answertextareas[{{$form->id}}][]" class="form-control shadow"></textarea>
                                            @break
                                            @case(3)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <input name="answerdates[{{$form->id}}][]" type="date" class="form-control shadow">
                                                    </div>
                                                </div>
                                                @break
                                            @case(4)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <input name="answertimes[{{$form->id}}][]" type="time" class="form-control shadow">
                                                    </div>
                                                </div>
                                                @break
                                            @case(5)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <input name="answeryears[{{$form->id}}][]" type="number" step="1" class="form-control shadow" min="1901" max="2100">
                                                    </div>
                                                </div>
                                                @break
                                            @case(6)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <input name="answerintegers[{{$form->id}}][]" type="number" step="1" class="form-control shadow" min="{{ $form->range->min }}" max="{{ $form->range->max }}">
                                                    </div>
                                                    <div class="col-md-1">
                                                        @if ($form->unit_id !== null)
                                                            <p>
                                                                <b>{{ $form->unit->einheit }}</b>
                                                            </p>   
                                                        @endif
                                                    </div>
                                                </div> 
                                                @break
                                            @case(7)
                                                <div class="row">
                                                        <div class="col-md-5">
                                                        <input name="answerdoubles[{{$form->id}}][]" type="number" step="0.01" class="form-control shadow" min="{{ $form->range->min }}" max="{{ $form->range->max }}">
                                                        </div>
                                                    <div class="col-md-1">
                                                        @if ($form->unit_id !== null)
                                                            <p>
                                                                <b>{{ $form->unit->einheit }}</b>
                                                            </p>   
                                                        @endif
                                                    </div>
                                                </div> 
                                                @break
                                            @default
                                        @endswitch
                                    @elseif($form->formtype_id == 2)
                                        
                                            @foreach($form->choices as $choice) 
                                                <input name="check[]" value="{{ $choice->id}}" type="checkbox"> {{$choice->choicestext}}<br>
                                            @endforeach
                                        
                                    @elseif($form->formtype_id == 3)
                                            @foreach($form->choices as $choice) 
                                                
                                                <input name="radio[{{$form->frtext}}]" value="{{$choice->id}}" type="radio">{{$choice->choicestext}}<br>
                                                    
                                            @endforeach
                                    @else
                                        Keine Angabe
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning">
                                <strong>Beantwortung nicht möglich!</strong> Es sind keine <strong>Fragen</strong> vorhanden!
                            </div>
                        @endif
                    </div>
                {{Form::submit('Antwort speichern', ['class' => 'btn submit-button'])}}   
            </div>
        {!! Form::close() !!}
    </div>        
</div>
</section>
@endsection