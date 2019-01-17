@extends('layouts.user-template')

@section('content')
@section('title')
    Befragungen: Übersicht
@stop
<section class="content">
    <div class="container-fluid pb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mt-4">
                    {{-- Zugriffsberechtigung prüfen --}}
                    @foreach ($role->rights as $right)
                        @if ($right->resultcreate)
                        {{-- Button öffnet Modal, um Studie anzulegen --}}
                            <button class="btn btn-md create-button float-sm-right float-right" 
                                data-toggle="modal" data-target="#addModalAntwort" 
                                type="button" name="button" >
                                    <span class="fa fa-plus"></span> Befragung starten
                            </button> 
                        @endif                        
                    @endforeach
                </div>
                <div class="col-md-12">
                    <h2 class="card-text">
                        <span class="fa fa-check-square-o"></span> 
                        Befragungen
                    </h2>
                </div>
            </div>
        </div>
        @if(count($results) > 0)
            @foreach($results as $result)
            <div class="col-md-12 mt-4">               
                <div class="row border rounded m-2 pt-4 pb-4">
                    <div class="col-md-8">
                        <h3>
                            <a href="/answers/{{$result->id}}" class="index-text">
                                {{$result->crfName}}
                            </a>
                        </h3>
                        <p>Patient <strong> {{$result->panachname}}, {{$result->pavorname}} </strong></p>
                        <small>Erstellt am {{date('d.m.Y H:i', strtotime($result->created_at))}} von <strong>{{$result->vorname}} {{$result->nachname}}</strong></small>
                    </div>
                    @foreach ($role->rights as $right)
                        @if(Auth::user()->id == $result->user_id && $right->resultedit)
                            <div class="col-md-2">
                                <a href="/answers/{{$result->id}}/edit" class="btn btn-default border-dark">
                                    <span class="fa fa-cogs"></span> Bearbeiten</a>
                            </div> 
                        @endif 
                    @endforeach
                </div>
            </div>
            @endforeach
        {{$results->links()}}
    @else
        <p>Keine Antworten vorhanden</p>
    @endif
    </div>
</section>
<div class="col-md-12">   

    

    {{-- Modal für Start der Befragung --}}
    <div class="modal" tabindex="-1" role="dialog" id="addModalAntwort">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Beantwortung starten</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form class="" action="{{route('answers.create')}}" method="get">
                      {{csrf_field()}}

                      <label for="study_id"><strong>1. Studie wählen:</strong></label>
                      @if(count($studies) > 0)
                              <select name="study_id" id="study_id" class="col-md-12 alert border rounded" required onchange="showCRFS(this.value)">
                                  <option value="">Wähle eine Studie..</option>
                                  @foreach($studies as $study)
                                      <option value="{{$study->id}}">{{$study->studyname}}</option>
                                  @endforeach
                              </select>
                              <div id="show"></div>
                      @else
                          <div class="alert alert-warning">
                              <strong>Beantwortung nicht möglich!</strong> Es sind keine <strong>Studien</strong> vorhanden!
                          </div>
                      @endif

                    <input type="submit" name="submit" value="Befragung starten" class=" btn submit-button">
                  </form>
                </div>
              </div>
            </div>
          </div>
</div>

<script>
    
    function showCRFS(str) {
        
          if (str.length == 0) { 
            document.getElementById("show").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var x = document.getElementById("study_id").value;
                    document.getElementById("show").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "/getcrfs/"+ str , true);
            xmlhttp.send();
        }
    }
    </script>
@endsection
