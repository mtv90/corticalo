<div id="unit">
        <div class="button-group">
            <button class="btn btn-sm cancel-button" onclick="removeUnit()"><i class="fa fa-minus"></i></button>
        </div>
        <label for="unit_id"><strong>Maßeinheit wählen</strong></label>
    
        <select name="unit_id" id="unit_id" class="form-control">
            <option value="">Wähle eine Einheit..</option>
            @foreach($units as $unit)
                <option value="{{$unit->id}}"
                    <?php 
                        if($unit->id == $form->unit_id){
                            echo "selected";
                        }
                    ?>
                    >{{$unit->einheit}}</option>
            @endforeach
        </select>
    </div>
