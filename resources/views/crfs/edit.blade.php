@extends('layouts.user-template')

@section('content')
@section('title')
    {{$crf->crfName}}: bearbeiten
@stop
<section class="content">
    <div class="container-fluid">

        <div class="col-md-7 offset-md-2 pt-4">
            <h2 class="mb-4">CRF bearbeiten</h2>
            
            {!! Form::open(['action'=> ['CrfsController@update', $crf->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('crfName', 'CRF-Name')}}
                {{Form::text('crfName', $crf->crfName, ['class'=> 'form-control', 'placeholder' => 'CRF-Name eingeben', 'autocomplete' => 'off'])}}
            </div>
            @if(count($forms) > 0)
                <div class="form-group">
                    {{ Form::label('forms', 'Fragen:' ) }}
                    {{-- {{ Form::select('forms[]', $forms, null, ['class' => 'form-control', 'multiple' => 'multiple', 'selected' ] ) }} --}}
                    <select class="js-example-basic-multiple" name="forms[]" id="forms" multiple style="width:100%">
                        @foreach($forms as $form)
                            <option value="{{$form->id}}" 
                                <?php 
                                    // hole alle Fragen, die zugeordnet wurden und selektiere sie
                                    foreach ($crf->forms as $crform) {
                                        if($crform->id == $form->id){
                                            echo "selected";
                                        }
                                    }   
                                ?>
                                > {{$form->frtext}} </option>
                        @endforeach
                    </select>
                </div>
            @endif


            <div class="">
                <button class="btn btn-md create-button mb-3 " 
                data-toggle="modal" data-target="#addModalForm" 
                type="button" name="button">
                <span class="fa fa-plus"></span> Erstelle Frage</button>
            </div>

            @if(count($studies) > 0)
                <div class="form-group">
                    {{ Form::label('studies', 'Studien:' ) }}
                    <select class="js-example-basic-multiple" name="studies[]" id="studies" multiple style="width:100%">
                            @foreach($studies as $study)
                                <option value="{{$study->id}}" 
                                    <?php 
                                        // hole alle Studien, die zugeordnet wurden und selektiere sie
                                        foreach ($crf->studies as $crfstudy) {
                                            if($crfstudy->id == $study->id){
                                                echo "selected";
                                            }
                                        }   
                                    ?>
                                    > {{$study->studyname}} </option>
                            @endforeach
                    </select>
                </div>
            @endif
            <a href="/crfs" class="btn btn-md cancel-button mb-3 float-right"><span class="fa fa-times"></span> Abbrechen</a>
            
            {{Form::hidden('_method', 'PUT')}}
            <div class="">
                <input type="submit" name="submit" value="speichern" class="add-study btn submit-button">    
            </div>
            {!! Form::close() !!}

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
                            {!! Form::open(['action'=> 'FormsController@addForm', 'method' => 'POST']) !!}
                            {{csrf_field()}}
                            <div class="form-group">
                                {{Form::label('frtext', 'Frage')}}
                                {{Form::text('frtext', '', ['class'=> 'form-control', 'placeholder' => 'Frage eingeben', 'autocomplete' => 'off'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('formtype_id', 'Fragetyp auswählen')}} <br>
                                <select class="form-control" name="formtype_id" required onchange="showFormats(this.value)">
                                    <option value="">Fragetyp auswählen...</option>
                                    @foreach($formtypes as $formtype)
                                        <option value="{{ $formtype->id }}"> {{$formtype->type}} </option>
                                    @endforeach
                                </select>
                                <div class="form-group" id="showFormat"></div> 
                            </div>
                            {{Form::submit('Frage anlegen', ['class' => 'add-form btn submit-button'])}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection