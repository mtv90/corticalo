@extends('layouts.user-template')

@section('content')
@section('title')
{{ config('app.name', 'corticalo') }} | Dashboard
@stop
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 card-text">Eingeloggt als <strong>{{ $role->roletype }}</strong></h3>
            </div>
        </div>
        <hr>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="col-md-12 mt-4 ">
            <div class="row">
            {{-- Zugriffsrechte prüfen --}}
                @foreach ($role->rights as $right)
                    @if ($right->studindex == 1)  
                    {{-- Ansicht für angelegte Studien --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-text"><span class="fa fa-book"></span> Meine Studien</h3>
                                    {{-- Berechtigung prüfen --}}
                                    @foreach ($role->rights as $right)
                                        @if ($right->studicreate == 1)
                                            <button class="btn btn-md create-button mb-4 float-right" data-toggle="modal" data-target="#addModal" 
                                                type="button" name="button" >
                                                    <span class="fa fa-plus"></span> Erstelle Studie
                                            </button>   
                                        @endif
                                    @endforeach
                                    {{-- --- --}}
                                </div>
                                <div class="card-body">
                                    @if(count($myStudies) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                @foreach($myStudies as $study)
                                                    <tr>
                                                        <td>
                                                            <a href="/studies/{{$study->id}}" class="card-text">
                                                                {{$study->studyname}}
                                                                {{-- prüfe nach zugeordneten CRFs --}}
                                                                @if(count($study->crfs) > 0)
                                                                    <span class="badge border"> 
                                                                        {{count($study->crfs)}} 
                                                                        <span class="fa fa-file-text"></span>
                                                                    </span>
                                                                @else 
                                                                    <span class="badge border"> 
                                                                        <span class="fa fa-exclamation" style="color:tomato"></span>
                                                                        {{count($study->crfs)}} 
                                                                        <span class="fa fa-file-text"></span>
                                                                    </span>
                                                                @endif
                                                                {{-- Prüfe nach Patienten --}}
                                                                @if(count($study->patients) > 0)
                                                                    <span class="badge border"> 
                                                                        {{count($study->patients)}} 
                                                                        <span class="fa fa-group"></span>
                                                                    </span>
                                                                @else 
                                                                    <span class="badge border">
                                                                        <span class="fa fa-exclamation" style="color:tomato"></span> 
                                                                        {{count($study->patients)}} 
                                                                        <span class="fa fa-group"></span>
                                                                    </span>
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{-- Berechtigung prüfen --}}
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->studiedit == 1)
                                                                    <a href="/studies/{{$study->id}}/edit" class="btn btn-sm btn-default border-dark float-right">
                                                                        <span class="fa fa-cogs"></span>            
                                                                    </a>  
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->studidelete == 1)
                                                                    <span class="button-group">
                                                                        <button data-id="{{$study->id}}" type="button" name="button" class="delete-study btn btn-sm btn-danger">
                                                                            <span class="fa fa-trash-o"></span>
                                                                        </button>
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                            {{-- --- --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <small>{{$myStudies->links()}}</small>
                                    @else
                                        <hr>
                                        <p>Du hast noch keine Studie erstellt</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- --Ende StudienCard-- --}}
                    @endif
                @endforeach
                {{-- --- --}}

                {{-- Zugriffsrechte prüfen --}}
                @foreach ($role->rights as $right)
                    @if ($right->crfindex == 1)  
                        {{-- Ansicht für angelegte CRFs --}}    
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-text"><span class="fa fa-file-text"></span> Meine CRFs</h3>
                                    {{-- Berechtigung prüfen --}}
                                    @foreach ($role->rights as $right)
                                        @if ($right->crfcreate == 1)
                                            <button class="btn btn-md create-button mb-4 float-right" 
                                                data-toggle="modal" data-target="#addModalCRF" 
                                                    type="button" name="button">
                                                    <span class="fa fa-plus"></span> 
                                                    Erstelle CRF
                                            </button>
                                        @endif
                                    @endforeach
                                    {{-- --- --}}
                                </div>
                                <div class="card-body">
                                    @if(count($crfs) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                @foreach($crfs as $crf)
                                                    <tr>
                                                        <td>
                                                            <a href="/crfs/{{$crf->id}}/show" class="card-text">
                                                                {{$crf->crfName}}
                                                                {{-- Prüfe nach zugeordneten Studien --}}
                                                                @if(count($crf->studies) > 0)
                                                                    <span class="badge border"> 
                                                                        {{count($crf->studies)}}
                                                                        <span class="fa fa-book"></span>
                                                                    </span>
                                                                @else
                                                                    <span class="badge border"> 
                                                                        <span class="fa fa-exclamation" style="color:tomato"></span>
                                                                        {{count($crf->studies)}}
                                                                        <span class="fa fa-book"></span>
                                                                    </span>
                                                                @endif
                                                                {{-- Prüfe nach zugeordneten Fragen --}}
                                                                @if(count($crf->forms) > 0)
                                                                    <span class="badge border"> 
                                                                        {{count($crf->forms)}}
                                                                        <span class="fa fa-question"></span>
                                                                    </span>
                                                                @else
                                                                    <span class="badge border"> 
                                                                        <span class="fa fa-exclamation" style="color:tomato"></span>
                                                                        {{count($crf->forms)}}
                                                                        <span class="fa fa-question"></span>
                                                                    </span>
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{-- Berechtigung prüfen --}}
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->crfedit == 1)
                                                                    <a href="/crfs/{{$crf->id}}/edit" class="btn btn-sm btn-default border-dark float-right">
                                                                        <span class="fa fa-cogs"></span>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->crfdelete == 1)
                                                                    <span class="button-group">
                                                                        <button data-id="{{$crf->id}}" type="button" name="button" class="delete-crf btn btn-sm btn-danger">
                                                                            <span class="fa fa-trash-o"></span>
                                                                        </button>
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                            {{-- --- --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <small>{{$crfs->links()}}</small>
                                    @else
                                        <hr>
                                        <p>Du hast noch keine CRFs erstellt</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Ende CRFCard --}}
                    @endif
                @endforeach
                {{-- --- --}}
                
                {{-- Zugriffsrechte prüfen --}}
                @foreach ($role->rights as $right)
                    @if ($right->formindex == 1) 
                        {{-- Ansicht für angelegte Fragen  --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-text"><span class="fa fa-question"></span> Meine Fragen</h3>
                                    {{-- Berechtigung prüfen --}}
                                    @foreach ($role->rights as $right)
                                        @if ($right->formcreate == 1)
                                            <button class="btn btn-md create-button mb-4 float-right" data-toggle="modal" data-target="#addModalForm" type="button" name="button">
                                                <span class="fa fa-plus"></span> 
                                                Erstelle Frage
                                            </button>
                                        @endif
                                    @endforeach
                                    {{-- --- --}}
                                </div>
                                <div class="card-body">
                                    @if(count($forms) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                @foreach($forms as $form)
                                                    <tr>
                                                        <td>
                                                            <a href="/forms/{{$form->id}}/show" class="card-text">
                                                                {{$form->frtext}}
                                                                {{-- Prüfe nach zugeordneten CRFs --}}
                                                                @if(count($form->crfs)>0)
                                                                    <span class="badge border">
                                                                        {{ count($form->crfs) }}
                                                                        <span class="fa fa-file-text"></span>
                                                                    </span>
                                                                @else
                                                                    <span class="badge border">
                                                                        <span class="fa fa-exclamation" style="color:tomato"></span>
                                                                        {{ count($form->crfs) }}
                                                                        <span class="fa fa-file-text"></span>
                                                                    </span>
                                                                @endif
                                                                {{-- Prüfe nach zugeordneten Auswahlen --}}
                                                                @if($form->formtype_id == 2 || $form->formtype_id == 3)
                                                                    @if(count($form->choices)>0)
                                                                        <span class="badge border"> 
                                                                            {{count($form->choices)}}
                                                                            <span class="fa fa-square"></span>
                                                                        </span>
                                                                    @else
                                                                        <span class="badge border"> 
                                                                            <span class="fa fa-exclamation" style="color:tomato"></span>
                                                                            {{count($form->choices)}}
                                                                            <span class="fa fa-square"></span>
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{-- Zugriffsrechte prüfen--}}
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->formedit == 1)
                                                                    <a href="/forms/{{$form->id}}/edit" class="btn btn-sm btn-default border-dark float-right">
                                                                        <span class="fa fa-cogs"></span>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->formdelete == 1)
                                                                    <span class="button-group">
                                                                        <button data-id="{{$form->id}}" type="button" name="button" class="delete-form btn btn-sm btn-danger">
                                                                            <span class="fa fa-trash-o"></span>
                                                                        </button>
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                            {{-- --- --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <small>{{$forms->links()}}</small>
                                    @else
                                        <hr>
                                        <p>Du hast noch keine Fragen erstellt</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Ende FrageCard --}}
                    @endif
                @endforeach
                {{-- --- --}}
            </div>
            {{-- Ansicht für die Anwender --}}
            <div class="row">
                {{-- Zugriffsrechte prüfen--}}
                @foreach ($role->rights as $right)
                    @if ($right->patindex == 1)
                        {{-- Übersicht über Patienten --}}
                        <div class="col-md-4" id="2">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-text">
                                        <span class="fa fa-address-book"></span> 
                                            Meine Patienten
                                    </h3>
                                    {{-- Zugriffsrechte prüfen--}}
                                    @foreach ($role->rights as $right)
                                        @if ($right->patcreate == 1)
                                            <a href="/patients/create" class="btn btn-md create-button mb-4 float-right">
                                                <span class="fa fa-plus"></span> 
                                                Erstelle Patienten
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    @if(count($mypatients)>0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                @foreach($mypatients as $mypatient)
                                                    <tr>
                                                        <td>
                                                            <a href="/patients/{{$mypatient->id}}" class="card-text">{{$mypatient->panachname}}, {{$mypatient->pavorname}}
                                                                @if(count($mypatient->results) > 0 )
                                                                    <span class="badge border" style="color:white; background-color:MediumSeaGreen;">
                                                                        {{count($mypatient->results)}}
                                                                        <span class="fa fa-check-square-o" ></span>
                                                                    </span>
                                                                @else
                                                                    <span class="badge border">
                                                                        <span class="fa fa-exclamation" style="color:red"></span>
                                                                    </span>
                                                                @endif  
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{-- Zugriffsrechte prüfen--}}
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->patedit == 1)
                                                                    <a href="/patients/{{$mypatient->id}}/edit" class="btn btn-sm btn-default border-dark float-right">
                                                                        <span class="fa fa-cogs"></span>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <small>{{$mypatients->links()}}</small>  
                                    @else
                                        <hr>
                                        <p>Du hast noch keinen Patienten angelegt</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Ende PatientenCard --}}
                    @endif
                @endforeach
                {{-- --- --}}

                {{-- Zugriffsrechte prüfen--}}
                @foreach ($role->rights as $right)
                    @if ($right->resultindex == 1)
                        {{-- Beginn BefragungsCard --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-text">
                                        <span class="fa fa-check-square-o"></span> 
                                        Meine Befragungen
                                    </h3>
                                    <button class="btn btn-md submit-button mb-4 float-right" data-toggle="modal" data-target="#addModalAntwort" type="button" name="button">
                                        <span class="fa fa-plus"></span> 
                                        Befragung starten
                                    </button>
                                </div>
                                <div class="card-body">
                                    @if(count($results)>0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                @foreach($results as $result)
                                                    <tr>
                                                        <td>
                                                            <a href="/answers/{{$result->id}}" class="card-text">
                                                                #{{$result->id}} | {{$result->crfName}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{-- Zugriffsrechte prüfen--}}
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->resultedit == 1)
                                                                    <a href="/answers/{{$result->id}}/edit" class="btn btn-sm btn-default border-dark float-right">
                                                                        <span class="fa fa-cogs"></span>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div> 
                                        <small>{{$results->links()}}</small>  
                                    @else
                                        <hr>
                                        <p>Du hast noch keine Befragungen durchgeführt</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Ende BefragungsCard --}}
                    @endif
                @endforeach

                {{-- Zugriffsrechte prüfen--}}
                @foreach ($role->rights as $right)
                    @if ($right->stats == 1)
                        {{-- Beginn Studienübersicht --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-text">
                                        <span class="fa fa-database"></span> 
                                        Studien
                                    </h3>
                                </div>
                                <div class="card-body">
                                    @if(count($studies)>0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                @foreach($studies as $study)
                                                    <tr>
                                                        <td>
                                                            #{{$study->id}} | {{$study->studyname}}
                                                        </td>
                                                        <td>
                                                            {{-- Zugriffsrechte prüfen--}}
                                                            @foreach ($role->rights as $right)
                                                                @if ($right->stats == 1)
                                                                    <a href="/studies/{{$study->id}}" class="btn btn-sm btn-default border-dark float-right"data-toggle="modal" data-target="#details" name="{{study_id}}" id="study_id" onclick="showDetails({{$study->id}})">
                                                                        <span class="fa fa-eye"></span>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>  
                                    @else
                                        <hr>
                                        <p>Du hast noch keine Befragungen durchgeführt</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Ende Studienübersicht --}}
                    @endif
                @endforeach
                {{-- --- --}}

                 {{-- Zeige Details zur Studie an --}}
                <div class="modal" tabindex="-1" role="dialog" id="details">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Details </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="view">
                                        
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Modal Form für Erstellung einer Studie --}}

<div class="modal" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Studie anlegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" action="{{route('studies.storeFrom')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">Name der Studie</label>
                        <input type="text" class="form-control" name="studyname" required autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Studienleiter</label>
                        <input type="text" class="form-control" name="director" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Studienbeschreibung</label>
                        <textarea class="form-control" name="studydescription" required></textarea>
                    </div>
                    @if(count($crfs) >0 ) 
                        
                        <div class="form-group">
                            <strong> {{ Form::label('crfs', 'CRFs:') }}</strong>
                          
                            <select name="crfs[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                                @foreach($crfs as $crf)
                                    <option class="" value=" {{$crf->id}} "> {{$crf->crfName}} </option>
                                @endforeach
                            </select>
                        </div>    
                        
                    @endif
                    @if(count($patients) >0 )
                        
                        <div class="form-group">
                            <strong> {{ Form::label('patients', 'Patienten:') }}</strong>
                            
                            <select name="patients[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                            @foreach($patients as $patient)
                                <option value=" {{$patient->id}} "> {{$patient->panachname}}, {{$patient->pavorname}} </option>
                            @endforeach
                            </select>
                        </div>
                        
                        @endif
                    <input type="submit" name="submit" value="Studie anlegen" class="add-study btn submit-button">
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal für Erstellung CRF --}}
<div class="modal" tabindex="-1" role="dialog" id="addModalCRF">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CRF anlegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{route('crfs.storeFromDash')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">CRF-Name</label>
                        <input type="text" class="form-control" name="crfName" required autofocus autocomplete="off">
                    </div>
                    @if(count($fragen) > 0)
                        <div class="form-group">
                            {{ Form::label('forms', 'Fragen:') }}
                            <select name="forms[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                                @foreach($fragen as $frage)
                                    <option value=" {{$frage->id}} "> {{$frage->frtext}} </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if(count($studies) > 0)
                        <div class="form-group">
                            {{ Form::label('studies', 'Studien:') }}
                            <select name="studies[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                                @foreach($studies as $study)
                                    <option value=" {{$study->id}} "> {{$study->studyname}} </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <input type="submit" name="submit" value="CRF anlegen" class="add-crf btn submit-button">
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal für Erstellung Frage --}}
<div class="modal" tabindex="-1" role="dialog" id="addModalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Frage anlegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action'=> 'FormsController@storeForms', 'method' => 'POST']) !!}
                {{csrf_field()}}
                <div class="form-group">
                    {{Form::label('frtext', 'Frage')}}
                    {{Form::text('frtext', '', ['class'=> 'form-control', 'placeholder' => 'Frage eingeben', 'required', 'autofocus', 'autocomplete'=>'off'])}}
                </div>
                <div class="form-group">  
                    {{Form::label('formtype_id', 'Fragetyp auswählen' , ['class' => ''])}}
                    <br>
                    <select class="form-control" name="formtype_id" required onchange="showFormats(this.value)">
                        <option value="">Fragetyp auswählen...</option>
                        @foreach($formtypes as $formtype)
                            <option value="{{ $formtype->id }}"> {{$formtype->type}} </option>
                        @endforeach
                    </select><br>
                    <div class="form-group" id="showFormat"></div>        
                </div>
                @if(count($crfs) >0 ) 
                    <div class="form-group">
                        <strong> {{ Form::label('crfs', 'CRFs:') }}</strong>
                        <select name="crfs[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                            @foreach($crfs as $crf)
                                <option value=" {{$crf->id}} "> {{$crf->crfName}} </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="">
                    {{Form::submit('Frage anlegen', ['class' => 'add-form btn submit-button'])}}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>

function showCRFS(str) {
    if (str.length == 0) { 
        document.getElementById("show").innerHTML = "";
        return;
    } 
    else {
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
function showDetails(id){
    if (id.length == 0) { 
        document.getElementById("view").innerHTML = "";
        return;
    } 
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var x = document.getElementById("study_id").value;
                document.getElementById("view").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/getstudy/"+ id , true);
        xmlhttp.send();
    }
}

</script>
@endsection