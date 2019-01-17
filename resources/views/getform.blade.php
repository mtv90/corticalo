    <div class="form-group">
        {{Form::label('form_id', 'Frage:')}}
        <select class="form-control" name="form_id">
                @if($form->formtype_id == 2 || $form->formtype_id == 3)
                    <option value="{{ $form->id }}"> {{$form->frtext}} </option>         
                @endif
        </select>
    </div>
  
