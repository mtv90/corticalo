@extends('layouts.user-template')


@section('content')
@section('title')
    CRFs: Übersicht
@stop
<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mt-4">
                    {{-- Zugriffsrechte prüfen --}}
                    @foreach ($role->rights as $right)
                        @if ($right->crfcreate == 1)
                            {{-- Button öffnet Modal, um Studie anzulegen --}}
                            <button class="btn btn-md create-button float-sm-right float-right" 
                                data-toggle="modal" data-target="#addModalCRF" 
                                type="button" name="button" >
                                    <span class="fa fa-plus"></span> Erstelle CRF
                            </button>
                        @endif
                    @endforeach
                    {{-- ---- --}}
                </div>
                <div class="col-md-12">
                    <h2 class="card-text">
                        <span class="fa fa-file-text"></span> 
                        Erstellte CRFs
                    </h2>
                </div>
            </div>
        </div>
        @if(count($crfs) > 0)
            @foreach($crfs as $crf )
                <div class="col-md-12 mt-4">
                    <div class="row border rounded m-2 pt-4 pb-4">
                        <div class="col-md-8 ">            
                            <h3>
                                <a href="/crfs/{{$crf->id}}/show" class="index-text">
                                    {{$crf->crfName}}
                                </a>
                            </h3>
                            <p>
                                <strong>{{ count($crf->forms) }}</strong> Frage/n hinzugefügt
                            </p>
                            <small>Erstellt am {{$crf->created_at}} von <strong>{{$crf->user->vorname}} {{$crf->user->nachname}}</strong></small>
                        </div>
                        @foreach ($role->rights as $right)
                            @if ($right->crfedit == 1)
                                <div class="col-md-2">
                                    <a href="/crfs/{{$crf->id}}/edit" class="btn btn-default border-dark border">
                                        <span class="fa fa-cogs"></span> Bearbeiten
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        @foreach ($role->rights as $right)
                            @if ($right->crfdelete == 1)
                                <div class="col-md-2">
                                    <span class="button-group">
                                        <button data-id="{{$crf->id}}" type="button" name="button" class="delete-crf btn btn-danger">
                                            <span class="fa fa-trash-o"></span> Löschen
                                        </button>
                                    </span>
                                </div>
                            @endif
                        @endforeach  
                    </div>
                </div>
            @endforeach
            {{$crfs->links()}}
        @else
            <p>Keine CRFs vorhanden</p>
        @endif
    </div>
</section>

<div class="col-md-12">
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
                <form class="" action="{{route('crfs.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">CRF-Name</label>
                        <input type="text" class="form-control" name="crfName" required autocomplete="off">
                    </div>
                    @if(count($fragen) > 0)
                        <div class="form-group">
                            {{ Form::label('forms', 'Fragen:') }}
                            <select name="forms[]" class="form-control select2-multi" multiple="multiple" >
                                @foreach($fragen as $frage)
                                    <option value=" {{$frage->id}} "> {{$frage->frtext}} </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if(count($studies) > 0)
                        <div class="form-group">
                            {{ Form::label('studies', 'Studien:') }}
                            <select name="studies[]" class="form-control select2-multi" multiple="multiple" >
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
</div>
@endsection