@extends('layouts.user-template')

@section('content')
@section('title')
    Recht erstellen
@stop
<section class="content">
    <div class="container-fluid">
            <div class="col-md-8 offset-md-2 pt-4 pb-4">
                    <a href="/rights" class="btn btn-default border-dark border mb-3">Zurück</a>
                    <h3 class="mb-4">Recht erstellen</h3>
                    {!! Form::open(['action'=> 'RightsController@store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                    <div class="form-group">
                        <div class="form-group">
                            {{Form::label('rightname', 'Bezeichnung')}}
                            {{Form::text('rightname', '', ['class'=> 'form-control', 'placeholder' => 'Rechtbezeichnung eingeben', 'autofocus', 'required'])}}
                        </div>
                        <div class="table-responsive-md">
                            <table class="table table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">{{Form::label('section', 'Bereich')}}</th>
                                        <th scope="col">{{Form::label('index', 'Index-View')}}</th>
                                        <th scope="col">{{Form::label('show', 'Detail-View')}}</th>
                                        <th scope="col">{{Form::label('show', 'Erstellen')}}</th>
                                        <th scope="col">{{Form::label('show', 'Bearbeiten')}}</th>
                                        <th scope="col">{{Form::label('show', 'Löschen')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Studie</th>
                                        <td>{{Form::checkbox('studindex','1')}} </td>
                                        <td>{{Form::checkbox('studishow','1')}} </td>
                                        <td>{{Form::checkbox('studicreate','1')}} </td>
                                        <td>{{Form::checkbox('studiedit','1')}} </td>
                                        <td>{{Form::checkbox('studidelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>CRFs</th>
                                        <td>{{Form::checkbox('crfindex','1')}} </td>
                                        <td>{{Form::checkbox('crfshow','1')}} </td>
                                        <td>{{Form::checkbox('crfcreate','1')}} </td>
                                        <td>{{Form::checkbox('crfedit','1')}} </td>
                                        <td>{{Form::checkbox('crfdelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>Fragen</th>
                                        <td>{{Form::checkbox('formindex','1')}} </td>
                                        <td>{{Form::checkbox('formshow','1')}} </td>
                                        <td>{{Form::checkbox('formcreate','1')}} </td>
                                        <td>{{Form::checkbox('formedit','1')}} </td>
                                        <td>{{Form::checkbox('formdelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>Auswahlen</th>
                                        <td>{{Form::checkbox('choiceindex','1')}} </td>
                                        <td>{{Form::checkbox('choiceshow','1')}} </td>
                                        <td>{{Form::checkbox('choicecreate','1')}} </td>
                                        <td>{{Form::checkbox('choiceedit','1')}} </td>
                                        <td>{{Form::checkbox('choicedelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>Befragung</th>
                                        <td>{{Form::checkbox('resultindex','1')}} </td>
                                        <td>{{Form::checkbox('resultshow','1')}} </td>
                                        <td>{{Form::checkbox('resultcreate','1')}} </td>
                                        <td>{{Form::checkbox('resultedit','1')}} </td>
                                        <td>{{Form::checkbox('resultdelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>Patienten</th>
                                        <td>{{Form::checkbox('patindex','1')}} </td>
                                        <td>{{Form::checkbox('patshow','1')}} </td>
                                        <td>{{Form::checkbox('patcreate','1')}} </td>
                                        <td>{{Form::checkbox('patedit','1')}} </td>
                                        <td>{{Form::checkbox('patdelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>User</th>
                                        <td>{{Form::checkbox('userindex','1')}} </td>
                                        <td>{{Form::checkbox('usershow','1')}} </td>
                                        <td>{{Form::checkbox('usercreate','1')}} </td>
                                        <td>{{Form::checkbox('useredit','1')}} </td>
                                        <td>{{Form::checkbox('userdelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>Rolle</th>
                                        <td>{{Form::checkbox('roleindex','1')}} </td>
                                        <td>{{Form::checkbox('roleshow','1')}} </td>
                                        <td>{{Form::checkbox('rolecreate','1')}} </td>
                                        <td>{{Form::checkbox('roleedit','1')}} </td>
                                        <td>{{Form::checkbox('roledelete','1')}} </td>
                                    </tr>
                                    <tr>
                                        <th>Rechte</th>
                                        <td>{{Form::checkbox('rightindex','1')}}</td>
                                        <td>{{Form::checkbox('rightshow','1')}}</td>
                                        <td>{{Form::checkbox('rightcreate','1')}}</td>
                                        <td>{{Form::checkbox('rightedit','1')}}</td>
                                        <td>{{Form::checkbox('rightdelete','1')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Ergebnisse</th>
                                        <td>{{Form::checkbox('stats', '1')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                        {{Form::submit('Recht speichern', ['class' => 'btn submit-button'])}}
                        {!! Form::close() !!}
                </div>
    </div>
</section>

@endsection


