@extends('layouts.user-template')

@section('content')
@section('title')
    {{$form->frtext}}: bearbeiten
@stop
<section class="content">
    <div class="container-fluid">

        <div class="col-md-7 offset-md-2 pt-4 pb-4">
            <h3 class="mb-4">Frage bearbeiten</h3>
            {!! Form::open(['action'=> ['FormsController@update', $form->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('frtext', 'Frage')}}
                {{Form::text('frtext', $form->frtext, ['class'=> 'form-control', 'placeholder' => 'Frage eingeben', 'autocomplete' => 'off'])}}
            </div>
            <div class="form-group">
                {{Form::label('formtype_id', 'Fragetyp')}} <br>
                <select class=" form-control" name="formtype_id" required id="formtype_id" onchange="showFormats(this.value)">
                        <option value="">Fragetyp auswählen...</option>
                    @foreach($formtypes as $formtype)
                        <option value="{{ $formtype->id }}"
                            <?php 
                                if($formtype->id == $form->formtype_id){
                                    echo "selected";
                                }
                            ?>> 
                            {{$formtype->type}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="showFormat"></div>
            @if (count($crfs)>0)
            <div class="form-group">
                <strong> {{ Form::label('crfs', 'CRFs:') }}</strong>
                <select name="crfs[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                    @foreach($crfs as $crf)
                        <option value=" {{$crf->id}} "
                            <?php 
                                // hole alle CRFs, die zugeordnet wurden und selektiere sie
                                foreach ($form->crfs as $formcrf) {
                                    if($formcrf->id == $crf->id){
                                        echo "selected";
                                        }
                                    }
                                ?>
                            > {{$crf->crfName}} </option>
                    @endforeach
                </select>
            </div>
            @endif 
            <br><hr>
                    
            <a href="/forms" class="btn btn-md cancel-button mb-3 float-right"><span class="fa fa-times"></span> Abbrechen</a>
            {{Form::hidden('_method', 'PUT')}}
                <input type="submit" name="submit" value="aktualisieren" class="btn submit-button">    
            {!! Form::close() !!}
        </div>
    </div>
</section>


<script type="text/javascript">


    let savedFormtype = <?php echo $form->formtype_id; ?>;
    
    function showEditFormats(savedValue){
        if (savedValue.length == 0) { 
            document.getElementById("showFormat").innerHTML = "";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("showFormat").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/geteditformats/"+ savedValue , true);
        xmlhttp.send();
    }
    
    function showEditUnit(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("showUnit").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "/getsavedunits/" + str , true);
            xmlhttp.send();
        }
    
    showEditFormats({{$form->id}});
    
    function removeUnit(){
            $("#unit").remove();
        }

    
    window.onload = function(){
        
        let unitID = <?php 
            if( $form->unit_id != null){
                echo $form->unit_id; 
            }
            else{
                echo "`leer`";
            }
            ?>;
       
        unitID !== "leer" ? showEditUnit({{$form->id}}) : '';

        function showEditRanges(str){

            if(this.savedFormtype == 1 && (str == 6 || str == 7)) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("showRange").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/getranges/"+ str , true);
                xmlhttp.send();
            }else{
                document.getElementById("showRange").innerHTML = "";
                return;
            }
        }

        function showEditRanges(str){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("showRange").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "/getsavedranges/"+ str , true);
            xmlhttp.send();
        }
        
        let rangeID = <?php 
            if( $form->range_id != null){
                echo $form->range_id; 
            }
            else{
                echo "`leer`";
            }
            ?>;
       
        rangeID !== "leer" ? showEditRanges({{$form->id}}) : '';
        
    }
    
</script>
@endsection




