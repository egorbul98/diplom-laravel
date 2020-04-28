@extends('layouts.default')

@section('content')
<div class="main-wrap">
    <div class="login-form">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="text">Регистрация</p> 
                    <a href="{{route("login")}}" class="btn-register">@lang('main.login')</a>

                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-field">
                            <label for="name" class="form-label"><i class="fas fa-user-circle"></i></label>

                            <input id="name" type="text" class="input-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="@lang('main.username')">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-field">
                            <label for="email" class="form-label"><i class="fas fa-at"></i></label>

                            <input id="email" type="email" class="input-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-field">
                            <label for="password" class="form-label"><i class="fas fa-unlock-alt"></i></label>


                            <input id="password" type="password"
                                class="input-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="@lang('main.password')">
                                
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-field">
                            <label for="password-confirm" class="form-label"><i class="fas fa-unlock-alt"></i></label>


                            <input id="password-confirm" type="password" class="input-control"
                                name="password_confirmation" required autocomplete="new-password" placeholder="@lang('main.password_confirmation')">
                                
                        </div>

                        <div class="form-field mb-0">

                            <button type="submit" class="btn btn-login">
                                @lang('main.registration')
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
