<label for="format_id"><strong>Format wählen</strong></label>

<select name="format_id" id="format_id" class="form-control" required onchange="showRanges(this.value)">
    <option value="">Wähle ein Format..</option>
    @foreach($formats as $format)
        <option value="{{$format->id}}"
            <?php 
            
                if($format->id == $form->format_id){
                    echo "selected";
                }
            ?>> 
            {{$format->formats}} 
        </option>
    @endforeach
</select><br>
<div class="button-group">
    <button type="button" class="btn create-button pull-right" onclick="showUnit()">
            <i class="fa fa-plus"></i> Einheit angeben</button>
</div>
<br>

<div class="form-group" id="showUnit"></div>

<div class="form-group" id="showRange"></div>
