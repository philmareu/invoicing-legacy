@extends('layouts.app')

@section('content')
    <div class="uk-width-medium-1-5 uk-vertical-align-middle">
        <div id="login-box">
            <div class="title-bar"><i class="uk-icon-lock"></i> Reset Password</div>
            <form class="uk-form uk-text-left" method="POST" action="{{ url('password/reset') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('email') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <i class="uk-icon-envelope"></i>
                            <input type="text" placeholder="Email" name="email" class="uk-form-width-large" value="{{ old('email') }}">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('password') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <i class="uk-icon-lock"></i>
                            <input type="password" placeholder="Password" name="password" class="uk-form-width-large">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('password') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <i class="uk-icon-lock"></i>
                            <input type="password" placeholder="Confirm Password" name="password_confirmation" class="uk-form-width-large">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <div class="uk-width-1-1">
                        <input type="submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
