@if(count($study->crfs) > 0)
<div class="col-md-12">
    <h5>{{ $study->studyname }}</h5> <small>von {{$study->director}} </small>
    <div class="col-md-12 alert border">
        <p>CRFs:</p> 
        <div class="col-md-4">Antworten
            @if(count($study->results) > 0) 
                <span class="badge border" style="color:white; background-color:MediumSeaGreen;">{{count($study->results)}}</span>
            @else
                <span class="badge border" style="color:white; background-color:Tomato;">{{count($study->results)}}</span>
            @endif 
        </div>
        @foreach($study->crfs as $crf)
            <p><strong>{{$crf->crfName}}</strong></p>
            <div class="col-md-12">Patienten
                @if(count($study->patients)>0) 
                    <span class="badge border" style="color:white; background-color:MediumSeaGreen;">{{count($study->patients)}}</span>
                @else
                    <span class="badge border" style="color:white; background-color:Tomato;">{{count($study->patients)}}</span>
                @endif 
            </div>
            <hr>
        @endforeach
    </div>
</div>    
@endif