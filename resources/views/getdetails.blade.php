<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h3 class="m-4">{{$crf->crfName}} </h3>
            <div class="table-responsive">
                <table class="table table-hover col-md-12">
                    <thead>
                        <th>Frage</th>
                        <th>Antwort</th>
                    </thead>
                    <tbody>
                        {{-- Gehe alle Fragen durch --}}
                        @foreach($forms as $form)
                        <tr>
                            {{-- Gebe mir den Fragetext --}}
                            <td>{{ $form->frtext }}</td>
                            <td>
                                {{-- Zuerst prüfen, um welchen Fragetyp es sich handelt und gebe dann die jeweilige/n Antwort/en aus --}}
                                @switch($form->formtype_id)
                                    @case(1)
                                        @foreach($result->textresults as $textresult)
                                            {{$textresult->answertextarea}}  
                                        @endforeach
                                        @break
                                    @case(2)
                                        @foreach($result->choices as $choice)
                                        {{-- prüfe, ob Antwort zur Frage gehört --}}
                                            @if($choice->form_id == $form->id)
                                                [{{$choice->choicestext}}]
                                            @endif 
                                        @endforeach
                                        @break
                                    @case(3)
                                        @foreach($result->choices as $choice)
                                            @if($choice->form_id == $form->id)
                                                [{{$choice->choicestext}}]
                                            @endif
                                        @endforeach
                                        @break
                                    @case(4)
                                        @foreach($result->textresults as $textresult)
                                            {{$textresult->answertext}}   
                                        @endforeach
                                        @break
                                    @default
                                        Keine Angabe
                                @endswitch  
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>                   
</div>
