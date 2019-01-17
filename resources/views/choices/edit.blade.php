@extends('layouts.user-template')

@section('content')
@section('title')
    {{$choice->choicestext}}: bearbeiten
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-7 offset-md-2 pt-4"> 
            {{-- <a href="/choices" class="btn border m-3"><span class="fa fa-angle-double-left"></span> Zurück</a> --}}
            <h3 class="mb-4">Auswahl bearbeiten</h3>

            {!! Form::open(['action'=> ['ChoicesController@update', $choice->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('choicestext', 'Bezeichnung')}}
                {{Form::text('choicestext', $choice->choicestext, ['class'=> 'form-control', 'placeholder' => 'Bezeichnung eingeben'])}}
            </div>
            <div class="form-group">
                {{Form::label('form_id', 'Frage:')}}
                <select class="form-control" name="form_id">
                    @foreach($forms as $form)
                        <option value="{{ $form->id }}"
                            <?php 
                                if($form->id == $choice->form_id){
                                    echo "selected";
                                }                       
                            ?>> 
                            {{$form->frtext}} 
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- {{$studies->links()}} --}}
            <a href="/choices" class="btn btn-md cancel-button mb-3 float-right"><span class="fa fa-times"></span> Abbrechen</a>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Auswahl speichern', ['class' => 'btn submit-button'])}}
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection