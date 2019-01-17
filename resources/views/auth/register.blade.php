@extends('layouts.login-register-template')

@section('content')
        <div class="container-fluid hintergrund"> 
            <div class="row justify-content-center" >
                <div class="col-md-12 col-sm-12 col-lg-8">
                    <div class="card abstand">
                        <div class="card-header">{{ __('Register') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="vorname" class="col-md-4 col-form-label text-md-right">{{ __('Vorname') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="vorname" type="text" class="form-control{{ $errors->has('vorname') ? ' is-invalid' : '' }}" name="vorname" value="{{ old('vorname') }}" required autofocus autocomplete="off">
        
                                        @if ($errors->has('vorname'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('vorname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="nachname" class="col-md-4 col-form-label text-md-right">{{ __('Nachname') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="nachname" type="text" class="form-control{{ $errors->has('nachname') ? ' is-invalid' : '' }}" name="nachname" value="{{ old('nachname') }}" required autocomplete="off">
        
                                        @if ($errors->has('nachname'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nachname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Addresse') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="off">
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
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Passwort bestätigen') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="role_id" class="col-md-4 col-form-label text-md-right">{{__('Benutzerrolle')}}</label>
                                    <div class="col-md-6">
                                        <select id="role_id" name="role_id" class="form-control" required>
                                            <option>Bitte auswählen...</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}"> {{$role->roletype}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-login">
                                            {{ __('Registrieren') }}
                                        </button>
                                        <hr>
                                    </div>
                                    <div class="col-md-2 offset-md-4">
                                        <a class="btn btn-sm btn-default border"  href="/" style="color:rgb(74, 135, 146);">Startseite</a>
                                    </div>
                                    <div class="col-md-2 offset-md-2">
                                        <a class="btn btn-sm btn-default border"  href="{{ route('login') }}" style="color:rgb(74, 135, 146);">Anmelden</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

