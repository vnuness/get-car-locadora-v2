@extends('layouts.wrapper')

@section('content')
    <div class="wrapper-page">

        <div class="text-center">
            <a href="index.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span>Meeta - Register</span> </a>
        </div>

        <form class="form-horizontal m-t-20" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                        </div>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('Name') }}">

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                        </div>
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required placeholder="{{ __('Email') }}">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="mdi mdi-key"></i></span>
                        </div>
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               required placeholder="{{ __('Password') }}">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="mdi mdi-key"></i></span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required placeholder="{{ __('Confirm Password') }}">
                    </div>
                </div>
            </div>

            <div class="form-group text-right m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-primary btn-custom waves-effect waves-light w-md" type="submit">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection
