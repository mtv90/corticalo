@extends('layouts.user-template')

@section('content')
@section('title')
   Frage: {{$form->frtext}}
@stop
<div class="col-md-8 offset-md-2 pt-4 pb-4">
    <a href="/forms" class="btn btn-default border-dark border mb-3">Zurück</a>
    <h2 class="mb-4">{{$form->frtext}}</h2>
    <hr>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th>Fragetyp</th>
                <th>Format</th>
                <th>Einheit</th>
                <th>Wertebereich</th>
                <th>Auswahl</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $aktuellerTyp->type }}
                    </td>
                    <td>
                        {{ $format->formats }}
                    </td>
                    <td>
                        @if(count($unit) > 0 )
                            {{ $unit->einheit }}
                        @else
                            ---
                        @endif 
                    </td>
                    <td>
                        @if(count($range) > 0 )
                            {{ $range->min }} <= X <= {{ $range->max }}
                        @else
                            ---
                        @endif 
                    </td>
                    <td>
                        @if($form->formtype_id == 2 || $form->formtype_id == 3)
                            @if(!count($form->choices)>0)
                                <p class="alert-warning">Bitte Auswahlmöglichkeiten hinzufügen!
                                    <a href="/choices/create" class="btn btn-default border-dark border">zur Auswahlerstellung</a>
                                </p>
                            @else
                            <ul>
                                @foreach($form->choices as $choice)
                                   <li>[ {{ $choice->choicestext }} ]</li>
                                @endforeach
                            </ul>
                            @endif
                        @else
                            ---
                        @endif
                    </td>
                </tr>                
            </tbody>
        </table>
    </div>
    <hr>
    <small>von {{$form->user->vorname}} {{$form->user->nachname}}</small>
    <hr>
    {{-- Zugriffsrechte prüfen --}}
    @if(!Auth::guest())
        @foreach ($role->rights as $right)
            @if($right->formedit == 1 || Auth::user()->id == $form->user_id)
                <a href="/forms/{{$form->id}}/edit" class="btn btn-default border-dark border">
                    <span class="fa fa-cogs"></span> Bearbeiten
                </a>
            @endif
        @endforeach
        @foreach ($role->rights as $right)
            @if($right->formdelete == 1 || Auth::user()->id == $form->user_id)
                {!! Form::open(['action' => ['FormsController@destroy', $form->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Löschen', ['class'=>'btn btn-danger'])}}
                {!! Form::close() !!}
            @endif
        @endforeach
    @endif
    {{-- --- --}}
</div>
@endsection
