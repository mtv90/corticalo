@extends('layouts.user-template')

@section('content')
@section('title')
    Befragung: {{$crf->crfName}}
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-9 offset-md-1 pt-4 pb-4">
            <a href="/answers" class="btn btn-default border-dark border mb-3"> 
                Zurück
            </a>
            <h2 class="mb-4">{{$crf->crfName}} </h2>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <small><strong>{{ $patient->panachname }}, {{ $patient->pavorname }}</strong></small>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover col-md-12">
                            <thead>
                                <th>Frage</th>
                                <th>Antwort</th>
                            </thead>
                            <tbody>
                            {{-- Gehe alle Fragen durch --}}
                                @foreach($forms as $form)
                                    <tr>
                                        @if($form->formtype_id == 1)
                                            @switch($form->format_id)
                                                @case(1)
                                                    @foreach($result->textresults as $textresult)
                                                        @if($form->id == $textresult->form_id)
                                                            <td>{{ $textresult->form->frtext }}</td>
                                                            <td>{{$textresult->answertext}}</td>
                                                        @endif 
                                                    @endforeach
                                                    @break
                                                @case(2)
                                                    @foreach($result->textarearesults as $textarearesult)
                                                        @if($form->id == $textarearesult->form_id)
                                                            <td>{{ $textarearesult->form->frtext }}</td>
                                                            <td>{{$textarearesult->answertextarea}}</td>
                                                        @endif
                                                    @endforeach
                                                    @break
                                                @case(3)
                                                    @foreach($result->dateresults as $dateresult)
                                                        @if($form->id == $dateresult->form_id)
                                                            <td>{{ $dateresult->form->frtext }}</td>
                                                            <td>{{date('d.m.Y', strtotime($dateresult->answerdate))}}</td>
                                                        @endif 
                                                    @endforeach
                                                    @break
                                                @case(4)
                                                    @foreach($result->timeresults as $timeresult)
                                                        @if($form->id == $timeresult->form_id)
                                                            <td>{{ $timeresult->form->frtext }}</td>
                                                            <td>{{$timeresult->answertime}} Uhr</td>
                                                        @endif
                                                    @endforeach
                                                    @break
                                                @case(5)
                                                    @foreach($result->yearresults as $yearresult)
                                                        @if($form->id == $yearresult->form_id)
                                                            <td>{{ $yearresult->form->frtext }}</td>
                                                            <td>{{$yearresult->answeryear}}</td>
                                                        @endif
                                                    @endforeach
                                                    @break
                                                @case(6)
                                                    @foreach($result->integerresults as $integerresult)
                                                        @if($form->id == $integerresult->form_id)
                                                            <td>{{ $integerresult->form->frtext }}</td>
                                                            <td>{{$integerresult->answerinteger}} 
                                                                @if($form->unit_id !== null)
                                                                    {{ $form->unit->einheit }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    @break
                                                @case(7)
                                                    @foreach($result->doubleresults as $doubleresult)
                                                        @if($form->id == $doubleresult->form_id)
                                                            <td>{{ $doubleresult->form->frtext }}</td>
                                                            <td>{{$doubleresult->answerdouble}}
                                                                @if($form->unit_id !== null)
                                                                    {{ $form->unit->einheit }}
                                                                @endif 
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    @break
                                                @default
                                                    Keine Anworten gefunden
                                            @endswitch
                                        @elseif($form->formtype_id == 2)
                                            <td> {{ $form->frtext }} </td>
                                            {{-- prüfe, ob Antwort zur Frage gehört --}}
                                            <td>
                                                @foreach($result->choices as $choice)
                                                    @if ($choice->form_id == $form->id)
                                                        [ {{$choice->choicestext}} ]
                                                    @endif        
                                                @endforeach
                                            </td>    
                                        @elseif($form->formtype_id == 3)
                                            <td>{{ $form->frtext }}</td>
                                            <td>
                                                @foreach($result->choices as $choice)
                                                    @if ($choice->form_id == $form->id)
                                                        [ {{$choice->choicestext}} ]
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- {{$result->id}} --}}
                    
                    @if(!Auth::guest())
                        @foreach($role->rights as $right)
                            @if(Auth::user()->id == $result->user_id && $right->resultdelete == 1 )
                                {!! Form::open(['action' => ['ResultsController@confirmDelete', $result->id ], 'method' => 'POST', 'class' => 'float-right']) !!}
                                    {{-- {{Form::hidden('_method', 'PUT')}} --}}
                                    <input type="number" name="resultID" value="{{$result->id}}" hidden>
                                    {{Form::submit('Löschen', ['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}
                            @endif
                        @endforeach
                    @endif
                </div>                   
            </div>
        </div>
    </div>
</section>
@endsection
