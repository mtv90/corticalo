@extends('layouts.user-template')

@section('content')
@section('title')
    Confirmation
@stop
<div class="col-md-6 offset-md-3 pt-5 pb-4">
    <h2 class="mb-4">Beantworteten CRF löschen</h2>
    <a href=" {{$val}} " class="btn btn-default btn-sm border-dark border mb-3">Zurück</a>
    <div class="alert border mt-5">   
        <p>
            Sie sind im Begriff, einen beantworteten Prüfbogen zu löschen. Dieser lässt sich im Anschluss nicht wiederherstellen. 
        </p>
        <br>
        <p>
            <b>Sind Sie sich sicher, dass Sie diesen Eintrag löschen möchten?</b>
        </p>
    </div>
    <form action="" method="post">
        {{csrf_field()}}
        {{Form::hidden('_method', 'DELETE')}}
        <button class="btn btn-danger">Ja, Antwort löschen</button>
        <a href="/answers" class="btn btn-md cancel-button" style="text-decoration: none"><span class="fa fa-times"></span> abbrechen</a>
    </form>   
</div>
@endsection