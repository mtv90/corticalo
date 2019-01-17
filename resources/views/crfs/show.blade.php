@extends('layouts.user-template')

@section('content')
@section('title')
    CRF: {{$crf->crfName}}
@stop
<div class="col-md-8 offset-md-2 pt-4 pb-4">
    <a href="/crfs" class="btn btn-default border-dark border mb-3">Zurück</a>
        <h2 class="mb-4">{{$crf->crfName}} </h2>
        <hr>
        <table class="table table-hover">
            <thead>
                <th>Fragen</th>
                <th>Fragetyp</th>
                <th>Format</th>
                <th>Einheit</th>
                <th>Auswahl</th>
            </thead>
            <tbody>
                @foreach($crf->forms as $form)
                    <tr>
                        <td> 
                            <a href="/forms/{{$form->id}}" style="color:black;">{{ $form->frtext }}</a>
                        </td>
                        <td>
                            @switch($form->formtype_id)
                                @case(1)
                                    Eingabe
                                    @break
                                @case(2)
                                    Checkbox
                                    @break
                                @case(3)
                                    Radiobutton
                                    @break
                                @default
                                    Keine Angabe
                            @endswitch
                        </td>
                        <td>
                            @switch($form->format_id)
                                @case(1)
                                    Textfeld
                                    @break
                                @case(2)
                                    Textarea
                                    @break
                                @case(3)
                                    Datum
                                    @break
                                @case(4)
                                    Uhrzeit
                                    @break
                                @case(5)
                                    Jahr
                                    @break
                                @case(6)
                                    Ganzzahl
                                    @break
                                @case(7)
                                    Gleitkommazahl
                                    @break
                                @default
                                    ---
                                @endswitch
                        </td>
                        <td>
                            @if($form->unit_id !== null)
                                {{ $form->unit->einheit }}
                            @endif
                        </td>
                        <td> 
                            @foreach($form->choices as $choice) 
                                @if($form->formtype_id == 2 || $form->formtype_id == 3)
                                   [{{ $choice->choicestext }}]
                                @else
                                   ---
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        @if(!Auth::guest())
            @foreach ($role->rights as $right)
                @if(Auth::user()->id == $crf->user_id || $right->crfdelete == 1)
                    {!! Form::open(['action' => ['CrfsController@destroyAsync', $crf->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Löschen', ['class'=>'btn btn-danger '])}}
                    {!! Form::close() !!}
                @endif 
            @endforeach
            @foreach ($role->rights as $right)
                @if (Auth::user()->id == $crf->user_id || $right->crfedit == 1)
                    <a href="/crfs/{{$crf->id}}/edit" class="btn btn-default border-dark border"><span class="fa fa-cogs"></span> Bearbeiten</a>
                @endif
            @endforeach
        @endif
</div>
@endsection