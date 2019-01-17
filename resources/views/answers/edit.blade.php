@extends('layouts.user-template')

@section('content')
@section('title')
    {{$crf->crfName}}: bearbeiten
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-8 offset-md-1 pt-4 pb-4">
            <h2 class="mb-4">Bearbeitung</h2>
            {{-- Beginn Formular zum Überarbeiten eines bearbeiteten Prüfbogens--}}
            {!! Form::open(['action'=> ['ResultsController@update', $result->id], 'method' => 'POST']) !!}
                <div class="col-md-12">
                    <div class="row alert alert-light border rounded">
                        <div class="col-md-6">
                            <label for="crf_id"><strong>CRF:</strong></label> 
                            <select name="crf_id" id="crf_id" class="col-md-12 alert border rounded">
                                <option value="{{$crf->id}}">#{{$crf->id}} {{$crf->crfName}}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="patient_id"><strong>Patient:</strong></label>
                            <select id="patient_id" name="patient_id" class="col-md-12 alert border rounded" required>
                                <option value="{{$patient->id}}">{{$patient->panachname}},{{$patient->pavorname}}</option>
                            </select>
                        </div>

                        {{-- Lösung, damit auch eine Zuordnung in Tabelle form_result möglich ist --}}
                        <select name="forms[]"  multiple="multiple" hidden>
                            @foreach($crf->forms as $form)
                                <option value=" {{$form->id}} " selected> {{$form->frtext}} </option>
                            @endforeach
                        </select>
                        <div class="col-md-12">   
                            {{-- Beginn der Beantwortung der Fragen!!! --}}
                            @if(count($result->forms) > 0)
                                @foreach($result->forms as $form)
                                <div class="alert border">
                                    <label for="{{$form->frtext}}">{{ $form->frtext }}</label>
                                    <br>
                                    @if($form->formtype_id == 1)
                                        @switch($form->format_id)
                                            @case(1) 
                                                @foreach($form->textresults as $text)
                                                    @if($text->answertext !== null && $text->result_id == $result->id)
                                                        <input name="answertexts[{{$form->id}}][]" class="form-control" value="{{ $text->answertext }}"> 
                                                    @endif
                                                @endforeach
                                            @break
                                            @case(2)
                                                @foreach($form->textarearesults as $area)
                                                    @if($area->answertextarea !== null && $area->result_id == $result->id)
                                                        <textarea name="answertextareas[{{$form->id}}][]" class="form-control">{{ $area->answertextarea }}</textarea> 
                                                    @endif
                                                @endforeach
                                            @break
                                            @case(3)
                                                @foreach($dateresults as $date)
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            @if($date->answerdate !== null && $date->form_id == $form->id)
                                                                <input name="answerdates[{{$form->id}}][]" type="date" class="form-control" value="{{ $date->answerdate }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach 
                                            @break
                                            @case(4)   
                                                @foreach($timeresults as $time)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @if($time->answertime !== null && $time->form_id == $form->id)
                                                            <input name="answertimes[{{$form->id}}][]" type="time" class="form-control" value="{{ $time->answertime }}"> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            @break
                                            @case(5)
                                                @foreach($yearresults as $year)
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            @if($year->answeryear !== null && $year->form_id == $form->id)
                                                                <input name="answeryears[{{$form->id}}][]" type="number" step="1" class="form-control" min="1901" max="2100" value="{{ $year->answeryear }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @break
                                            @case(6)   
                                                @foreach($form->integerresults as $integer)
                                                    @if($integer->result_id == $result->id) 
                                                        <div class="row">
                                                            <div class="col-md-5"> 
                                                                <input name="answerintegers[{{$form->id}}][]" type="number" step="1" class="form-control" min="{{ $form->range->min }}" max="{{ $form->range->max }}" value="{{ $integer->answerinteger }}"> 
                                                            </div>
                                                            @if($integer->form->unit->einheit != null)
                                                                <div class="col-md-1">
                                                                    <b>{{ $integer->form->unit->einheit}}</b>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @break
                                            @case(7)
                                                @foreach($form->doubleresults as $double)
                                                    @if($double->result_id == $result->id)
                                                        <div class="row">
                                                            <div class="col-md-5"> 
                                                                <input name="answerdoubles[{{$form->id}}][]" type="number" step="0.01" class="form-control" min="{{ $form->range->min }}" max="{{ $form->range->max }}" value="{{ $double->answerdouble }}">
                                                            </div>
                                                            @if($double->form->unit->einheit != null)
                                                                <div class="col-md-1">
                                                                    <b>{{ $double->form->unit->einheit}}</b>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif        
                                                @endforeach
                                            @break
                                            @default
                                                keine Antworten vorhanden
                                            @break
                                        @endswitch
                                    @elseif($form->formtype_id == 2)
                                        @foreach($form->choices as $choice)
                                            @if($form->formtype_id == 2)
                                                <input name="choices[]" value="{{ $choice->id}}" type="checkbox"
                                                    <?php 
                                                    // hole alle Antwortmöglichkeiten, die angewählt wurden und setze entsprechend das Häckchen
                                                        foreach ($result->choices as $answered) {
                                                            if($answered->id == $choice->id){
                                                                echo "checked";
                                                            }
                                                        }   
                                                    ?> >{{$choice->choicestext}}<br>
                                            @else
                                                ---
                                            @endif
                                        @endforeach
                                    @elseif($form->formtype_id == 3)
                                        @foreach($form->choices as $choice) 
                                            <input name="choices[{{$form->frtext}}]" value="{{$choice->id}}" type="radio"
                                                <?php 
                                                // hole alle Antwortmöglichkeiten, die angewählt wurden und setze entsprechend das Häckchen
                                                    foreach ($result->choices as $answered) {
                                                        if($answered->id == $choice->id){
                                                            echo "checked";
                                                        }
                                                    }   
                                                ?> 
                                            > {{$choice->choicestext}}<br>
                                        @endforeach                                       
                                    @endif
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-12">
                            <a href="/answers" class="btn btn-md cancel-button mb-3 float-right" style="text-decoration: none"><span class="fa fa-times"></span> abbrechen</a>
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Antwort speichern', ['class' => 'btn submit-button'])}}  
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div> 
    </div>
</section>
@endsection