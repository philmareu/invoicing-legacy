@extends('layouts.default')

@section('content')

<h1>{{ icon('clients') }} Clients > Create</h1>

<div class="uk-grid">
	<div class="uk-width-3-5 uk-push-2-10">
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Create Client</h3>
			<div class="uk-grid">
				<div class="uk-width-1-1">
                    <form action="{{ route('clients.store') }}" method="POST" class="uk-form uk-form-stacked">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('laraform::elements.form.text', ['field' => ['name' => 'title']])
                        @include('laraform::elements.form.text', ['field' => ['name' => 'address_1']])
                        @include('laraform::elements.form.text', ['field' => ['name' => 'address_2']])
                        @include('laraform::elements.form.text', ['field' => ['name' => 'city']])
                        @include('laraform::elements.form.text', ['field' => ['name' => 'state']])
                        @include('laraform::elements.form.text', ['field' => ['name' => 'zip']])
                        @include('laraform::elements.form.text', ['field' => ['name' => 'phone']])

                        <div class="uk-form-row">
                            @include('laraform::elements.form.submit')
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop