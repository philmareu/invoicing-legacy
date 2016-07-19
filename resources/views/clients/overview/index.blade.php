@extends('layouts.default')

@section('content')

<h1>{{ icon('clients') }} Clients > Overview</h1>

<div class="uk-grid">
	
	<div class="uk-width-medium-6-10 uk-margin-large-bottom">
		
		@include('clients.overview.recent')
		
		@if(count($withInvoices))
		<div class="uk-panel uk-panel-box">
			@include('clients.overview.invoices')
		</div>
		@endif
		
		@if(count($newClients))
		<div class="uk-panel uk-panel-box">
			@include('clients.overview.new')
		</div>
		@endif

	</div>
	
	<div class="uk-width-medium-4-10">
		@include('clients.overview.sidebar')
	</div>
</div>

@stop