@extends('layouts.user-template')

@section('content')
@section('title')
    Auswahl erstellen
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-7 offset-md-2 pt-4">
            <a href="/choices" class="btn btn-default border-dark border mb-3">Zurück</a>
            <h3 class="mb-4">Auswahl erstellen</h3>
            {!! Form::open(['action'=> 'ChoicesController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('choicestext', 'Bezeichnung')}}
                    {{Form::text('choicestext', '', ['class'=> 'form-control', 'placeholder' => 'Bezeichnung eingeben', 'autocomplete' => 'off', 'autofocus'])}}
                </div>
                @if(count($forms)>0)
                    <div class="form-group">
                        
                        {{Form::label('form_id', 'Frage:')}}
                        <select class="js-example-basic-single" name="form_id" style="width:100%">
                            @foreach($forms as $form)
                                @if($form->formtype_id== 2 || $form->formtype_id == 3)
                                    <option value="{{ $form->id }}"> {{$form->frtext}} </option>       
                                @endif                  
                            @endforeach
                        </select>
                    </div>
                    {{Form::submit('Auswahl anlegen', ['class' => 'btn submit-button'])}}
            {!! Form::close() !!}
                @else
                    <p class="alert message-alert">Keine Frage vorhanden!</p>
                    <a href="/forms/create" class="btn btn-md submit-button float-right">Frage erstellen</a>  
                @endif
        </div>
    </div>
</section>
@endsection