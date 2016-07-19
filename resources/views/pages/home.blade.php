@extends('layouts.public')

@section('content')

<header class="home uk-vertical-align">
	<div class="uk-vertical-align-middle">
		<h1>WorkTop</h1>
		<p>The essential toolset for freelancers or small businesses.</p>
		<a href="{{ url('register') }}" class="uk-button trial">Try it free for 30 days</a>
	</div>
</header>

<div class="uk-container uk-container-center">

			
	<h2>Features</h2>

	<div class="uk-grid">
		<div class="uk-width-1-3 uk-text-center">
			{{ icon('clients', 'large') }}
			<h3>Manage Clients</h3>
			<p>Keep track of your clients and their related projects and invoices. Whether you have 10 or 1000 clients, WorkTop will make it easy to find your active clients.</p>
		</div>
				
		<div class="uk-width-1-3 uk-text-center">
			{{ icon('projects', 'large') }}
			<h3>Simple project management</h3>
			<p>Create a project fast and keep related tasks and notes for future reference. Have trouble keeping track of your active projects? No problem! WorkTop knows what they are and keeps them in view.</p>
		</div>
				
		<div class="uk-width-1-3 uk-text-center">
			{{ icon('proposals', 'large') }}
			<h3>Track Proposals</h3>
			<p>Do you need some help staying under budget? Simply create a proposal and tell WorkTop the most time you would like to spend. It will present you with a graphical representation of your progress.</p>
		</div>
	</div>
			
	<div class="uk-grid">
		<div class="uk-width-1-2 uk-text-center">
			{{ icon('workorders', 'large') }}
			<h3>Doing work? Make a work order!</h3>
			<p>Work orders get you paid. Work orders allow you to track time, notes and tasks for any amount of work you need to do work for your clients. This powerful tool will provide a virtual document that you can always refer back to in the future. Once you have completed the work order, they can easily be attached to invoices. Now that's cool.</p>
		</div>
				
		<div class="uk-width-1-2 uk-text-center">
			{{ icon('invoices', 'large') }}
			<h3>Easy but powerful invoicing.</h3>
			<p>WorkTop can easily create beautiful easy to read invoices for your clients. Your clients can view these invoices online, and with your <a href="http://stripe.com">Stripe</a> account they can pay with a credit card. Don't want to except credit cards? No problem, you or your clients and print off the invoices and mail you payments.</p>
		</div>
	</div>
			
	<div class="uk-grid">
		<div class="uk-width-2-3 uk-push-1-6 uk-text-center">
			{{ icon('dashboard', 'large') }}
			<h3>View everything on your dashboard.</h3>
			<p>The dashboard gives you a simple way to see what activities are going on in your account.</p>
		</div>
	</div>

	
	<div class="uk-grid uk-text-center">
		<div class="uk-width-1-1">
			<a href="{{ url('register') }}" class="uk-button trial">Try it free for 30 days</a>
		</div>
	</div>
	
	<h2>Screenshots</h2>
	
	<div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
		
		@foreach($screenshots as $image => $caption)
		
		<div class="uk-width-medium-1-5">
			
			<a href="#{{ $image }}" data-uk-modal>
				<img class="uk-thumbnail" src="{{ asset('img/screenshots/' . $image . '-thumb.jpg') }}" alt="">
				<div class="uk-thumbnail-caption">{{ $caption }}</div>
			</a>

			<!-- This is the modal -->
			<div id="{{ $image }}" class="uk-modal">
				<div class="uk-modal-dialog uk-modal-dialog-frameless">
					<a href="" class="uk-modal-close uk-close uk-close-alt"></a>
					<img src="{{ asset('img/screenshots/' . $image . '-full.jpg') }}" alt="">
				</div>
			</div>
		</div>
		
	@endforeach
	
	</div>
	
	<div class="uk-grid uk-text-center">
		<div class="uk-width-1-1">
			<a href="{{ url('register') }}" class="uk-button trial">Try it free for 30 days</a>
		</div>
	</div>
	
</div>

@stop