@extends('layouts.user-template')

@section('content')
@section('title')
    Frage erstellen
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-7 offset-md-2 pt-4 pb-4">
            <a href="/forms" class="btn btn-default border-dark border mb-3">Zurück</a>
            <h3 class="mb-4">Frage erstellen</h3>
            {!! Form::open(['action'=> 'FormsController@store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            <div class="form-group">
                {{Form::label('frtext', 'Frage')}}
                {{Form::text('frtext', '', ['class'=> 'form-control', 'placeholder' => 'Frage eingeben', 'autofocus'])}}
            </div>
            <div class="form-group">
                {{Form::label('formtype_id', 'Fragetyp auswählen' , ['class' => ''])}} <br>
                <select class=" form-control" id="formtype_id" name="formtype_id" required onchange="showFormats(this.value)">
                        <option value="">Fragetyp auswählen...</option>
                    @foreach($formtypes as $formtype)
                        <option value="{{ $formtype->id }}"> {{$formtype->type}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="showFormat"></div>
            @if (count($crfs)>0)
            <div class="form-group">
                <strong> {{ Form::label('crfs', 'CRFs:') }}</strong>
                <select name="crfs[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                    @foreach($crfs as $crf)
                        <option value=" {{$crf->id}} "> {{$crf->crfName}} </option>
                    @endforeach
                </select>
            </div>
            @endif
                {{Form::submit('Frage anlegen', ['class' => 'btn submit-button'])}}
                {!! Form::close() !!}
        </div>
    </div>
</section>

@endsection


