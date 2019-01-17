@extends('layouts.user-template')

@section('content')
@section('title')
    CRF erstellen
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-7 offset-md-2 pt-4">
            <a href="/crfs" class="btn btn-default border-dark border mb-3">Zurück</a>
            <h3 class="mb-4">CRF erstellen</h3>
            {!! Form::open(['action'=> 'CrfsController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('crfName', 'CRF-Name')}}
                {{Form::text('crfName', '', ['class'=> 'form-control', 'placeholder' => 'CRF-Name eingeben', 'autofocus', 'autocomplete' => 'off'])}}
            </div>
            <div class="form-group">
                {{ Form::label('forms', 'Fragen:') }}
                <select name="forms[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                    @foreach($forms as $form)
                        <option value=" {{$form->id}} "> {{$form->frtext}} </option>
                    @endforeach
                </select>
            </div>
            {{Form::submit('CRF anlegen', ['class' => 'btn submit-button'])}}
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection

