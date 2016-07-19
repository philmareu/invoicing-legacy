@extends('layouts.default')

@section('content')

<h1>{{ icon('clients') }} Clients > Create</h1>

<div class="uk-grid">
	<div class="uk-width-3-5 uk-push-2-10">
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Create Client</h3>
			<div class="uk-grid">
				<div class="uk-width-1-1">
	
					{{ Form::open(array('route' => 'clients.store', 'class' => 'uk-form uk-form-stacked', 'files' => true)) }}
					{{ Form::hidden('slug', 'none') }}
	

					<ul class="uk-tab uk-margin-top" data-uk-tab={connect:'#panes'}>
						<li class="active"><a href="">General</a></li>
						<li><a href="">Additional Details</a></li>
					</ul>

					<ul id="panes" class="uk-switcher uk-margin-top">
						<li>
							@include('clients.create.tab1')
						</li>

						<li>
							@include('clients.create.tab2')
						</li>
					</ul>
	
					<h3>Then create a ...</h3>
	
					<div class="uk-grid">
						<div class="uk-width-1-1">
							{{ Form::radio('reference', 'none', true) }} None<br>
							{{ Form::radio('reference', 'projects') }} Project<br>
							{{ Form::radio('reference', 'invoices') }} Invoice<br>
							{{ Form::radio('reference', 'workorders') }} Work Order
						</div>
					</div>

					<!-- This is a button -->
					<button type="submit" class="uk-button uk-button-primary">Save</button>

					{{ Form::close() }}
	
				</div>
			</div>
		</div>
	</div>
</div>
@stop