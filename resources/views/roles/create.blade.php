@extends('layouts.user-template')

@section('content')
@section('title')
    Benutzerrolle erstellen
@stop
<section class="content">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2 pt-4 pb-4">
                <a href="/roles" class="btn btn-default border-dark border mb-3">Zurück</a>
                <h3 class="mb-4">Rolle erstellen</h3>
                {!! Form::open(['action'=> 'RolesController@store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                    <div class="form-group">
                        {{Form::label('roletype', 'Rolle')}}
                        {{Form::text('roletype', '', ['class'=> 'form-control', 'placeholder' => 'Bezeichnung eingeben', 'autofocus'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('right_id', 'Rechte auswählen' , ['class' => ''])}} <br>
                        <select class="js-example-basic-multiple form-control col-md-11 alert border rounded" name="rights[]" multiple="multiple" style="width:100%">
                            @foreach($rights as $right)
                                <option value="{{ $right->id }}"> {{$right->rightname}} </option>
                            @endforeach
                        </select>        
                    </div>
                    {{Form::submit('Benutzerrolle anlegen', ['class' => 'btn submit-button'])}}
                {!! Form::close() !!}
            </div>
        </div>
</section>
@endsection