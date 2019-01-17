@extends('layouts.user-template')

@section('content')
@section('title')
    Bestätigen
@stop

@foreach ($request as $item)
    {{ $item }}   
@endforeach
@endsection