@extends('layouts.login-register-template')

@section('content')
@section('title')
Login
@stop
    <div class="container-fluid hintergrund">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-sm-12 col-lg-8">
                        <div class="card abstand">
                            <div class="card-header">{{ __('Anmelden') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Addresse') }}</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Passwort') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Benutzer merken') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-login">
                                                {{ __('Anmelden') }}
                                            </button>
                                            <a class="btn btn-link" href="{{ route('password.request') }}" style="color:rgb(88, 89, 91);">
                                                {{ __('Passwort vergessen?') }}
                                            </a>
                                            <hr>
                                        </div>
                                        <div class="col-md-2 offset-md-4 col-sm-3">
                                            <a class="btn btn-sm btn-default border"  href="/" style="color:rgb(74, 135, 146);">Startseite</a>
                                        </div>
                                        <div class="col-md-2 offset-md-2 col-sm-3">
                                            <a class="btn btn-sm btn-default border"  href="{{ route('register') }}" style="color:rgb(74, 135, 146);">Jetzt registrieren</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection
