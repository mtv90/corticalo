@extends('layouts.login-register-template')
@section('content')
@section('title')
Kontakt
@stop

<section class="container-fluid hintergrund pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-8 col-lg-6">
            <div class="card abstand">
                <div class="card-content">
                    <div class="card-title">
                        <h2>Kontakt</h2>
                    </div>
                    <div class="row">
                        <form action="/kontakt" method="POST" class="col s12">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="input-field col s5">
                                    <input name="vorname" id="vorname" type="text" class="validate" required autofocus>
                                    <label for="vorname">Vorname</label>
                                </div>
                                <div class="input-field col s5">
                                    <input name="nachname" id="nachname" type="text" class="validate" required>
                                    <label for="nachname">Nachname</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s5">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="telefon" id="telefon" min="0" step="1" type="number" maxlength="16" class="validate">
                                    <label for="telefon">Telefon</label>
                                </div>
                                <div class="input-field col s5">
                                    <i class="material-icons prefix">email</i>
                                    <input name="email" id="email" type="email" class="validate" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s10">
                                    <i class="material-icons prefix">priority_high</i>
                                    <input name="betreff" id="betreff" type="text" class="validate" required maxlength="150">
                                    <label for="disabled">Betreff</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea name="message" id="message" class="materialize-textarea" required maxlength="450"></textarea>
                                    <label for="message">Nachricht</label>
                                </div>      
                            </div>
                            <div class="row">
                                <small><p class="col s12">
                                    <label>
                                        <input type="checkbox" required/>
                                        <span>Bitte lesen und akzeptieren Sie die <a href=" {{url('/datenschutz')}} ">Datenschutzerklärung</a></span>
                                    </label>
                                </p></small>
                            </div>
                            <button class="btn waves-effect waves-light" type="submit" name="action">senden
                                <i class="material-icons right">send</i>
                            </button>
                            <a href="/" class="btn cancel-button" type="submit" name="action">abbrechen
                                <i class="material-icons right">close</i>
                            </a>
                        </form>
                    </div>
                    @include('inc.messages')
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
