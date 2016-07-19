@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-20">
		<h1>Delete</h1>
	</div>
</div>

<div class="row">
	<div class="col-xs-20">

		{{ Form::open(array('route' => array('invoices.destroy', $invoice->id), 'method' => 'DELETE')) }}

		<p>Are your sure you want to delete invoice "{{ $invoice->invoice_number }}"?</p>

		{{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
		
		{{ link_to(URL::previous(), 'Cancel') }}

		{{ Form::close() }}

	</div>
</div>
@stop