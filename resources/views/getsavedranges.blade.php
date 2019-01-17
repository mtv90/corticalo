<label for="range_id"><strong>Wertebereich angeben</strong></label>
<div class="row">
    @if($form->format->formats == Ganzzahl)
        <div class="col-md-6">
            <label for="min">Untergrenze</label>
            
            <input class="form-control" value="{{$form->range->min}}" type="number" step="1" name="min" required>
        </div>
        <div class="col-md-6">
            <label for="max">Obergrenze</label>
            <input class="form-control" value="{{$form->range->max}}" type="number" step="1" name="max" required>
        </div>
    @elseif($form->format->formats == Gleitkommazahl)
        <div class="col-md-6">
            <label for="min">Untergrenze</label>
            <input class="form-control" value="{{$form->range->min}}" type="number" step="0.01" name="min" required>
        </div>
        <div class="col-md-6">
            <label for="max">Obergrenze</label>
            <input class="form-control" value="{{$form->range->max}}" type="number" step="0.01" name="max" required>
        </div>
    @endif
</div>
