@extends('layouts.default')

@section('content')
<div class="main-wrap">
    <div class="login-form">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="text">Авторизация</p> 
                    <a href="{{route("register")}}" class="btn-register">Регистрация</a>

                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-field">
                            <label for="email" class="form-label"><i class="fas fa-user-circle"></i></label>

                            <input id="email" type="email" class="input-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="password" class="form-label"><i class="fas fa-unlock-alt"></i></label>
                        
                            <input id="password" type="password" class="input-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Пароль">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-login">
                                    @lang('main.login')
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Забыли пароль?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Запомнить меня') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
