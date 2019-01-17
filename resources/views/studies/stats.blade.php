@extends('layouts.user-template')

@section('content')
@section('title')
    Studienergebnisse
@stop
<section class="content">
    <div class="container-fluid pb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4 mt-4">
                        <span class="fa fa-bar-chart"></span> 
                        Ergebnisse
                    </h2>
                </div>
            </div>
        </div> 
        <div class="col-md-12"> 
            @if(count($studies) > 0)
                @foreach($studies as $study)
                    <div class="col-md-12 mt-4">
                        <div class="row alert alert-light border rounded pt-4 pb-4">
                            <div class="col-md-12">
                                <h3> {{$study->studyname}} </h3> <small>Studienleiter [ {{$study->director}} ]</small>
                                @if(count($results)>0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td><strong>Beantwortete CRFs</strong></td>
                                                <td><strong>durchgeführt von</strong></td>
                                            </thead>
                                            <tbody>
                                                @foreach($results as $result)
                                                    @if($result->study_id == $study->id)
                                                        <tr>
                                                            <td>
                                                                <a id="result_id" data-target="#answer" 
                                                                    data-toggle="modal" onclick="showResult({{$result->id}})" style="cursor: pointer;">
                                                                        #{{$result->id}} | {{$result->crfName}}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                {{ $result->name }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>  
                                @else
                                    <hr>
                                    <p>Du hast noch keine Befragungen durchgeführt</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Noch keine Antworten vorhanden!</p>
            @endif
        </div>
    </div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="answer">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- Zugriffsberechtigung prüfen --}}
                @foreach ($role->rights as $right)
                    @if ($right->resultshow == 1)
                        <div class="modal-body">
                            <div id="result">
                                    
                            </div>
                        </div> 
                    @endif
                @endforeach
                {{-- ---- --}}
            </div>
        </div>  
      </div>

<script>
function showResult(id){

   if (id.length == 0) { 
       document.getElementById("result").innerHTML = "";
       return;
   } else {
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               var x = document.getElementById("result_id").value;
               document.getElementById("result").innerHTML = this.responseText;
           }
       };
       xmlhttp.open("GET", "/getdetails/"+ id , true);
       xmlhttp.send();
   }
}
</script>
@endsection