@extends('layouts.user-template')

@section('content')
@section('title')
   Rolle: {{$role->roletype}}
@stop
<div class="col-md-8 offset-md-2 pt-4 pb-4">
    <a href="/roles" class="btn btn-default border-dark border mb-3">Zurück</a>
    <h2 class="mb-4">{{$role->roletype}}</h2>
    <hr>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Benutzerrechte</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <ul class="list-group">
                            @if ( count($role->rights) > 0)
                                @foreach ($role->rights as $right)
                                <li class="list-group-item">[ {{ $right->rightname }} ]</li>
                                
                                @endforeach  
                            @else
                                <p>Leider hast du noch keine Rechte</p>
                            @endif
                        </ul>
                    </td>
                </tr>                
            </tbody>
        </table>
    </div>
    <hr>
    @if(!Auth::guest())
        @foreach($admit->rights as $right)
            @if($right->roleedit == 1 && Auth::user()->id == $role->user_id)
            <a href="/roles/{{$role->id}}/edit" class="btn btn-default border-dark border">
                <span class="fa fa-cogs"></span> Bearbeiten
            </a>
            @endif
        @endforeach
        @foreach($admit->rights as $right)
            @if($right->roledelete == 1 && Auth::user()->id == $role->user_id)
            {!! Form::open(['action' => ['RolesController@destroy', $role->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Löschen', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
            @endif
        @endforeach
    @endif
</div>
@endsection
