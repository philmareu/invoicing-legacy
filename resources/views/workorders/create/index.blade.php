@extends('layouts.default')

@section('content')

<h1>{{ icon('workorders') }} Work Orders > Create</h1>

<div class="uk-grid">
	<div class="uk-width-3-5 uk-push-2-10">
		
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Create Work Order</h3>
			
			<div class="uk-grid">
				<div class="uk-width-1-1">
	
					{{ Form::open(array('route' => 'workorders.store', 'class' => 'uk-form uk-form-stacked')) }}
	
					{{ Form::hidden('relation', 'Client', array('class' => 'relation')) }}
	
					<ul class="uk-tab" data-uk-tab={connect:'#panes'}>
						<li class="active"><a href="">General</a></li>
						<li><a href="">Additional Details</a></li>
					</ul>
			
					<ul id="panes" class="uk-switcher uk-margin-top">
						<li>
							@include('workorders.create.tab1')
						</li>

						<li>
							@include('workorders.create.tab2')
						</li>
					</ul>

					<button type="submit" class="uk-button uk-button-primary uk-margin-top">Save</button>
		
					{{ Form::close() }}

				</div>
			</div>
		</div>
	</div>
</div>

@stop

@section('scripts-footer')

<script src="{{ asset('js/workorders.js') }}"></script>
<script src="{{ asset('js/datepicker.min.js') }}"></script>

<script>

$(function(){

	$('[data-uk-switcher]').on('uk.switcher.show', function(event, area){
		$('input.relation').attr('value', area.text());
	});

});
	
</script>

@stop