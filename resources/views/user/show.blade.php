@extends('layouts.user-template')

@section('content')
@section('title')
{{$user->vorname}} {{$user->nachname}}
@stop
<div class="col-md-8 offset-md-2 pt-4 pb-4">
    <h2 class="mb-4">{{$user->vorname}} {{$user->nachname}}</h2>
    <hr>
    <div class="col-md-12 alert border">
        <p ><h5 class="col-md-12 alert border">Benutzerrolle: {{ $role->roletype }} </h5></p>
        <p ><h5 class="col-md-12 alert border">Benutzerrechte: 
            @if ( count($role->rights) > 0)
                @foreach ($role->rights as $right)
                [ {{ $right->rightname }} ]
                @endforeach  
            @else
                <p>Leider hast du noch keine Rechte</p>
            @endif
        </p>
    </div>
  
    {{-- Für eventuellen Ausbau des Benutzerrechte-Bereiches --}}
    {{-- --------------------------------- --}}
    {{-- @if(!Auth::guest())
        @foreach ($rights as $right)
            @if($right->useredit == 1)
                <a href="/studies/{{$study->id}}/edit" class="btn btn-default border-dark border">
                    <span class="fa fa-cogs"></span> Bearbeiten
                </a>
            @endif   
        @endforeach
    @endif --}}
</div>
@endsection