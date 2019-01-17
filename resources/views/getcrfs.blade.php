<label for="crf_id"><strong>2. CRF wählen:</strong></label>
    @if(count($study->crfs) > 0)
        <select name="crf_id" id="crf_id" class="col-md-12 alert border rounded" required>
        <option value="">Wähle einen CRF..</option>
        @foreach($study->crfs as $crf)
            <option value="{{$crf->id}}">{{$crf->crfName}}</option>
        @endforeach
        </select>
    @else
        <div class="alert alert-warning">
        <strong>Beantwortung nicht möglich!</strong> Es sind keine <strong>CRFs</strong> vorhanden!
        </div>
@endif
