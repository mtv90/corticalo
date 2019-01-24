@extends('layouts.user-template')

@section('content')
@section('title')
    Rechte: Übersicht
@stop
    <section class="content">
            <div class="container-fluid pb-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <a href="/rights/create" role="button" class="btn btn-md create-button mb-4 float-right">
                                <span class="fa fa-plus"></span>
                                Erstelle Recht
                            </a>
                        </div>
                        <div class="col-md-12">
                            <h2 class="card-text">
                                <span class="fa fa-book"></span> 
                                Erstellte Rechte
                            </h2>
                        </div>
                    </div>
                    @if(count($rights > 0))
                        @foreach($rights as $right)
                        <div class="col-md-12 mt-4">
                            <div class="row border rounded m-2 pt-4 pb-4">
                                <div class="col-md-8">
                                    <h3>  
                                        {{-- <a href="/rights/{{$right->id}}"></a> --}}
                                        <p class="index-text">
                                            {{ $right->rightname }} 
                                        </p> 
                                    </h3>
                                </div>
                                {{-- Dieser Bereich ist noch nicht fertig ausgebaut. Steht auf der Agenda in der Umsetzung Phase 2 --}}
                                {{-- @if(Auth::user()->id == $right->user_id)
                                    <div class="col-md-2">
                                        <a href="/rights/{{$right->id}}/edit" class="btn btn-default border-dark border">
                                            <span class="fa fa-cogs"></span> Bearbeiten
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="button-group">
                                            <button data-id="{{$right->id}}" type="button" name="button" class="delete-right btn btn-danger">
                                                    <span class="fa fa-trash-o"></span> Löschen
                                            </button>
                                        </span>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
    </section>
@endsection