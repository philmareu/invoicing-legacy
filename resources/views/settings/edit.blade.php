@extends('layouts.default')

@section('content')

<h1>Account > Settings</h1>

<div class="uk-grid">
	<div class="uk-width-1-1">
		
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Settings</h3>

            <form action="{{ route('settings.update') }}" method="POST" class="uk-form uk-form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">

                @include('laraform::elements.form.image', ['field' => ['name' => 'image', 'value' => $user->image]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'name', 'value' => $user->name]])
                @include('laraform::elements.form.email', ['field' => ['name' => 'email', 'value' => $user->email]])
                @include('laraform::elements.form.password', ['field' => ['name' => 'password']])
                @include('laraform::elements.form.text', ['field' => ['name' => 'rate', 'value' => $user->settings->rate]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_email', 'value' => $user->settings->invoice_email]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_address_1', 'value' => $user->settings->invoice_address_1]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_address_2', 'value' => $user->settings->invoice_address_2]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_city', 'value' => $user->settings->invoice_city]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_state', 'value' => $user->settings->invoice_state]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_zip', 'value' => $user->settings->invoice_zip]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_phone', 'value' => $user->settings->invoice_phone]])
                @include('laraform::elements.form.textarea', ['field' => ['name' => 'invoice_note', 'value' => $user->settings->invoice_note]])
                @include('laraform::elements.form.text', ['field' => ['name' => 'stripe_public', 'value' => $user->settings->stripe_public]])
                @include('laraform::elements.form.password', ['field' => ['name' => 'stripe_secret']])
                @if($user->settings->stripe_public)
                    <a href="{{ route('settings.remove-stripe') }}">Remove Stripe Keys</a>
                @endif
                <button type="submit" class="uk-button uk-button-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@stop