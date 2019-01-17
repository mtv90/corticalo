@extends('layouts.user-template')

@section('content')
@section('title')
    Patient: {{$patient->pavorname}} {{$patient->panachname}}
@stop
<div class="col-md-8 offset-md-2 pt-4 pb-4">
    <a href="/patients" class="btn btn-default border-dark border mb-3"><span class="fa fa-angle-double-left"></span> Zurück</a>
    <h1 class="mb-4">{{$patient->pavorname}} {{$patient->panachname}}</h1>
    <hr>
        <div class="table-responsive alert border">
            <table class="table table-hover col-md-12">
                <tr>
                    <th>PatientenID</th>
                    <th>Geburtsdatum</th>
                    <th>Geburtsort</th>
                </tr>
                <tr>
                    <td><b>{{$patient->id}}</b></td>
                    <td>{{$patient->pageburtsdatum}}</td>
                    <td>{{$patient->pageburtsort}}</td>
                </tr>
            </table>
        </div>

    <div class="table-responsive alert border">
            <table class="table table-striped col-md-12">
                <h6><strong>Zugeorndete Studien</strong></h6>
                <thead>
                    <th>Studienname (Studienleiter)</th>
                    <th>Beantwortete CRFs</th>
                </thead>
                <tbody>
                    @foreach($patient->studies as $study)
                    <tr>
                        <td> 
                            {{ $study->studyname }} ( {{$study->director}} )
                        </td>
                        <td>
                            @if(count($patient->results)>0)
                                @foreach($patient->results as $result)
                                <p>
                                    <a href="/answers/{{$result->id}}">#{{ $result->id }}
                                    <?php 
                                    if($study->id == $result->study_id)
                                    {
                                        $crf = App\CRF::find($result->crf_id);
                                        echo $crf->crfName;
                                    }
                                ?>
                                </a>
                                </p>
                                @endforeach
                            @else
                              <p>Es wurden noch keine Befragungen durchgeführt!</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @if(!Auth::guest())
        @if(count($role->rights)>0)
            @foreach($role->rights as $right)
                @if ($right->patedit == 1 && Auth::user()->id == $patient->user_id)
                    <a href="/patients/{{$patient->id}}/edit" class="btn btn-default border-dark border">
                        <span class="fa fa-cogs"></span> Bearbeiten
                    </a>
                @endif
            @endforeach
            @foreach($role->rights as $right) 
                @if ($right->patdelete == 1 && Auth::user()->id == $patient->user_id)  
                    {!! Form::open(['action' => ['PatientsController@destroy', $patient->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <span class="button-group">
                            <button data-id="{{$patient->id}}" type="submit" name="button" class="btn btn-danger">
                                <span class="fa fa-trash-o"></span> Löschen 
                            </button>
                        </span>
                    {!! Form::close() !!}
                @endif
            @endforeach
        @endif
    @endif
</div>
@endsection