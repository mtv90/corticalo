@extends('layouts.user-template')

@section('content')
@section('title')
    Benutzerrollen: Übersicht
@stop
<section class="content">
        <div class="container-fluid pb-4">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        {{-- Zugriffsberechtigung prüfen --}}
                        @foreach ($adrole->rights as $right)
                            @if ($right->rolecreate == 1)
                                <a href="/roles/create" role="button" class="btn btn-md create-button mb-4 float-right">
                                    <span class="fa fa-plus"></span>
                                    Erstelle Rolle
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <h2 class="card-text">
                            <span class="fa fa-book"></span> 
                            Erstellte Benutzerrollen
                        </h2>
                    </div>
                </div>
                @if(count($roles > 0))
                    @foreach($roles as $role)
                    <div class="col-md-12 mt-4">
                        <div class="row border rounded m-2 pt-4 pb-4">
                            <div class="col-md-8">
                                <h3>
                                    <a href="/roles/{{$role->id}}" class="index-text">
                                    {{ $role->roletype }} <span class="badge pull-right">{{count($role->rights)}} Rechte</span>
                                    </a> 
                                </h3>
                            </div>
                            @foreach ($adrole->rights as $right)
                                @if(Auth::user()->id == $role->user_id && $right->roleedit == 1)
                                    <div class="col-md-2">
                                        <a href="/roles/{{$role->id}}/edit" class="btn btn-default border-dark border">
                                            <span class="fa fa-cogs"></span> Bearbeiten
                                        </a>
                                    </div>
                                @endif 
                            @endforeach
                            @foreach ($adrole->rights as $right)
                                @if (Auth::user()->id == $role->user_id && $right->roledelete == 1)
                                    <div class="col-md-2">
                                        <span class="button-group">
                                            <button data-id="{{$role->id}}" type="button" name="button" class="delete-role btn btn-danger">
                                                    <span class="fa fa-trash-o"></span> Löschen
                                            </button>
                                        </span>
                                    </div>    
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
</section>
@endsection