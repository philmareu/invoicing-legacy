@extends('layouts.auth')

<!-- Main Content -->
@section('content')
    <div class="uk-width-medium-1-5 uk-vertical-align-middle">

        <div id="login-box">
            <div class="title-bar"><i class="uk-icon-lock"></i> Request Password Reset</div>

            <form class="uk-form uk-text-left" role="form" method="POST" action="{{ url('password/email') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                    <div class="uk-width-1-1">
                        <input type="submit"/>
                    </div>
                </div>

                <div class="uk-form-row"><a href="{{ url('login') }}"><i class="uk-icon-arrow-left"></i> Back</a></div>

            </form>
        </div>
    </div>
@endsection
