@extends('layouts.user-template')


@section('content')
@section('title')
    Auswahlen: Übersicht
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mt-4">
                    {{-- Zugriffsrechte prüfen --}}
                    @foreach ($role->rights as $right)
                        @if ($right->choicecreate == 1)
                        {{-- Button öffnet Modal, um Studie anzulegen --}}
                            <button class="btn btn-md create-button float-sm-right float-right" data-toggle="modal" data-target="#addModalChoice" type="button" name="button" >
                                <span class="fa fa-plus"></span> Erstelle Auswahl
                            </button>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-12">
                    <h2 class="card-text mb-4">
                        <span class="fa fa-square"></span> 
                        Erstellte Auswahlen
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="border" id="accordion">
                @foreach ($forms as $form)
                    @if ($form->formtype_id !== 1 )
                        <div class="card bg-light text-dark">
                            <div class="card-header">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$form->id}}">
                                    <h4 class="border rounded p-2">
                                        {{$form->frtext}} 
                                        @if (count($form->choices)>0)
                                            <span class="badge border"> {{count($form->choices)}} </span>
                                        @else
                                            <span class="fa fa-exclamation" style="color:tomato"></span>
                                        @endif
                                    </h4>
                                </a>
                                @if(count($form->choices) > 0)
                                    <button class=" btn btn-sm create-button mb-4 float-right" data-toggle="modal" 
                                        data-target="#addModalChoiceForm" type="button" name="button" id="formid" value="{{$form->id}}" onclick="getvalue(this.value)">
                                            <span class="fa fa-plus"></span>
                                    </button>
                                @endif 
                            </div>
                            @if (count($form->choices) > 0)
                                <div id="collapse{{$form->id}}" class="panel-collapse collapse in">
                                    @foreach($form->choices as $choice)
                                        <div class="card-body border">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-6 col-xs-6">
                                                    <h5>{{$choice->choicestext}}</h5>
                                                </div>
                                                {{-- <small>Erstellt am {{$choice->created_at}} von <strong>{{$choice->user->vorname}} {{$choice->user->nachname}}</strong> </small> --}}
                                                @if(!Auth::guest())
                                                    @foreach ($role->rights as $right)
                                                        @if($right->choiceedit == 1 || Auth::user()->id == $choice->user_id )
                                                            <div class="col-md-1 mb-1 col-sm-2 col-xs-2">
                                                                <a href="/choices/{{$choice->id}}/edit" class="btn btn-default border-dark border">
                                                                    <span class="fa fa-cogs"></span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($role->rights as $right)
                                                        @if(Auth::user()->id == $choice->user_id || $right->choicedelete == 1)
                                                            <div class="col-md-1 col-sm-2 col-xs-2">
                                                                <span class="button-group">
                                                                    <button data-id="{{$choice->id}}" type="button" name="button" class="delete-ch btn btn-danger">
                                                                        <span class="fa fa-trash-o"></span>
                                                                    </button>
                                                                </span>   
                                                            </div> 
                                                        @endif
                                                    @endforeach   
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif(!(count($form->choices) > 0))
                                <div id="collapse{{$form->id}}" class="panel-collapse collapse show">
                                    <div class="card-body">
                                        <p>Es sind noch keine Auswahlen vorhanden</p>
                                        <button class="btn btn-md create-button mb-4" 
                                            data-toggle="modal" data-target="#addModalChoiceForm" 
                                            type="button" name="button" id="formid" value="{{$form->id}}" onclick="getvalue(this.value)">
                                                <span class="fa fa-plus"></span> Erstelle Auswahl
                                        </button> 
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
                {{$forms->links()}}
            </div>  
        </div>        
    </div>   
</section>
 
{{-- Modal für Erstellung Auswahl --}}
<div class="modal" tabindex="-1" role="dialog" id="addModalChoice">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Auswahl anlegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action'=> 'ChoicesController@store', 'method' => 'POST']) !!}
                    {{csrf_field()}}
                    <div class="form-group">
                        {{Form::label('choicestext', 'Bezeichnung')}}
                        {{Form::text('choicestext', '', ['class'=> 'form-control', 'placeholder' => 'Bezeichnung eingeben', 'autocomplete' => 'off', 'autofocus'])}}
                    </div>
                    @if(count($forms)>0)
                        <div class="form-group">
                            {{Form::label('form_id', 'Frage:')}}
                            <select class="form-control" name="form_id" style="width:100%">
                                <option>Bitte auswählen</option>
                                @foreach($forms as $form)
                                    @if($form->formtype_id == 2 || $form->formtype_id == 3)
                                        <option value="{{ $form->id }}"> {{$form->frtext}} </option>         
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{Form::submit('Auswahl anlegen', ['class' => 'btn submit-button'])}}
                {!! Form::close() !!}
                    @else
                        <span class="alert alert-danger">Keine Frage vorhanden!</span>
                        <a href="/forms/create" class="btn btn-md create-button ">Frage erstellen</a>  
                    @endif
            </div>
        </div>
    </div>
</div>


{{-- Modal für Erstellung Auswahl einer spezifischen Frage --}}
<div class="modal" tabindex="-1" role="dialog" id="addModalChoiceForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Auswahl anlegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action'=> 'ChoicesController@store', 'method' => 'POST']) !!}
                    {{csrf_field()}}
                    <div class="form-group">
                        {{Form::label('choicestext', 'Bezeichnung')}}
                        {{Form::text('choicestext', '', ['class'=> 'form-control', 'placeholder' => 'Bezeichnung eingeben', 'autocomplete' => 'off', 'autofocus'])}}
                    </div>
                    <div id="showform"></div>
                    {{Form::submit('Auswahl anlegen', ['class' => 'btn submit-button'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function getvalue(str) {
    
        if (str.length == 0) { 
          document.getElementById("showform").innerHTML = "TEST";
          return;
      } else {
          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange = function() {
            
              if (this.readyState == 4 && this.status == 200) {
                  var x = document.getElementById("formid").value;
                  document.getElementById("showform").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET", "/getform/"+ str , true);
          xmlhttp.send();
      }
  }
  $("#toggler").click(function(){
  $("#ziel").toggle();
});
</script>
@endsection

