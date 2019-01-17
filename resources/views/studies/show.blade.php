@extends('layouts.user-template')

@section('content')
@section('title')
    Studie: {{$study->studyname}}
@stop
<div class="col-md-8 offset-md-2 pt-4 pb-4">
    <a href="/studies" class="btn btn-default border-dark border mb-3">Zurück</a>
    <h2 class="mb-4">{{$study->studyname}}</h2>
    <hr>
    <div class="col-md-12 alert border">
        <p ><h5 class="col-md-12 alert border">Studienleiter: {{ $study->director }} </h5></p>
        <p ><h5 class="col-md-12 alert border">Beschreibung: {{ $study->studydescription }} </h5></p>
        <p> <small>von {{$study->user->vorname}} {{$study->user->nachname}}</small></p>
    </div>
  
    <div class="table-responsive alert border">
        <table class="table table-hover col-md-12">
            <thead>
                <th>CRF-Name</th>
            </thead>
            <tbody>
                @foreach($study->crfs as $crf)
                <tr> 
                    <td>
                        <a href="/crfs/{{$crf->id}}" style="color:black;">{{ $crf->crfName }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive alert border">
            <table class="table table-hover col-md-12">
                <h6><strong>Patient/en</strong></h6>
                <thead>
                    <th>Name</th>
                    <th>Geburtsdatum</th>
                    <th>Geburtsort</th>
                </thead>
                <tbody>
                    @foreach($study->patients as $patient)
                    <tr>
                        <td> {{ $patient->panachname }}, {{ $patient->pavorname }}</td>
                        <td> {{$patient->pageburtsdatum}} </td>
                        <td> {{$patient->pageburtsort}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @if(!Auth::guest())
        @foreach ($role->rights as $right)
            @if(Auth::user()->id == $study->user_id || $right->studiedit == 1)
                <a href="/studies/{{$study->id}}/edit" class="btn btn-default border-dark border">
                    <span class="fa fa-cogs"></span> Bearbeiten
                </a>
            @endif
        @endforeach
    @endif
</div>
@endsection