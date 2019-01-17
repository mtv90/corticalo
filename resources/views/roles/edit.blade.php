@extends('layouts.user-template')

@section('content')
@section('title')
    {{$role->roletype}}: bearbeiten
@stop
<section class="content">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2 pt-4 pb-4">
                <a href="/roles" class="btn btn-default border-dark border mb-3">Zurück</a>
                <h3 class="mb-4">Rolle bearbeiten</h3>
                {!! Form::open(['action'=> ['RolesController@update', $role->id], 'method' => 'POST', 'autocomplete' => 'off']) !!}
                    <div class="form-group">
                        {{Form::label('roletype', 'Rolle')}}
                        {{Form::text('roletype', $role->roletype, ['class'=> 'form-control', 'placeholder' => 'Bezeichnung eingeben'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('right_id', 'Rechte auswählen' , ['class' => ''])}} <br>
                        <select class=" form-control" name="rights[]" multiple="multiple">
                            @foreach($rights as $right)
                                <option value="{{ $right->id }}"
                                    <?php 
                                        foreach ($role->rights as $admitrights) {
                                            if($admitrights->id == $right->id){
                                                echo "selected";
                                            }
                                        }
                                    ?>
                                    > {{$right->rightname}} </option>
                            @endforeach
                        </select>        
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Benutzerrolle anlegen', ['class' => 'btn submit-button'])}}
                {!! Form::close() !!}
            </div>
        </div>
</section>
@endsection