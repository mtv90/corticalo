@extends('layouts.user-template')

@section('content')
@section('title')
    Eingaben überprüfen
@stop
<div class="col-md-8 offset-md-2 pt-4 pb-4">
    <h2 class="mb-4">Eingaben überprüfen</h2>
    <a href="/studies/create" class="btn btn-default border-dark border mb-3">Zurück</a>
    {!! Form::open(['action'=> 'StudiesController@store', 'method' => 'POST']) !!}
    {{csrf_field()}}   
    @foreach ($request->request as $item => $key)
        @switch(count($request->request) > 0)
            @case($item == 'studyname')
                <h2 class="mb-4">{{ $key }}</h2>
                <hr>
                @break
            @case($item == 'director')
            <p><h5 class="col-md-12 alert border">Studienleiter: {{ $key }}</h5></p>
                @break
            @case($item == 'studydescription')
            <p><h5 class="col-md-12 alert border">Beschreibung: {{ $key }} </h5></p>
                @break
            @case($item == 'crfs')
                <div class="col-md-12 alert border"><h5>CRFs: </h5>
                    <ul class="list-group">
                        @foreach ($key as $item)  
                            <li class="list-group-item">{{ App\CRF::find($item)->crfName }}</li>
                        @endforeach
                    </ul>
                </div>
                @break
            @case($item == 'patients')
                <div class="col-md-12 alert border"><h5>Patienten: </h5>
                    <ul class="list-group">
                        @foreach ($key as $item)
                            <?php $pat = App\Patient::find($item) ?>
                            <li class="list-group-item">{{$pat->pavorname}} {{ $pat->panachname }}, geb.
                                <?php
                                    $date=date_create($pat->pageburtsdatum);
                                    echo date_format($date,"d.m.Y");
                                ?>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @break
            @default
        @endswitch
    @endforeach
    {{Form::submit('Studie speichern', ['class' => 'btn submit-button'])}}
    {!! Form::close() !!}
</div>
@endsection