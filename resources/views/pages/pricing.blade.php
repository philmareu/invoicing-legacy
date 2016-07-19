@extends('layouts.public')

@section('content')

<div class="uk-container uk-container-center">

	<div class="uk-grid uk-margin-large-top">
		<div class="uk-width-1-1">
			<h1>Pricing</h1>
			
			<div class="uk-grid">
				<div class="uk-width-1-1">
					<p class="uk-text-center uk-text-large">30 day free trial. No credit card required and no contracts!</p>
				</div>
			</div>
			
			<div class="uk-grid">
				<div class="uk-width-1-3">
					<div class="uk-panel uk-panel-box">
						<div class="uk-panel-teaser">
							<img src="{{ asset('img/sunflower-1.jpg') }}" alt"">
						</div>
						<h3 class="uk-panel-title">Basic - $4 / Month</h3>
						<ul class="uk-list">
							<li>Unlimited Work Orders</li>
							<li>Unlimited Proposals</li>
							<li>10 Invoices per month</li>
							<li>10 Clients</li>
							<li>10 Projects</li>
							<li>1 user</li>
						</ul>
						
						<hr>
						
						<ul class="uk-list">
							<li><i class="uk-icon-check-circle"></i> Export</li>
							<li><i class="uk-icon-check-circle"></i> Reports</li>
							<li class="uk-text-muted"><i class="uk-icon-times-circle"></i> Client Portal</li>
							<li class="uk-text-muted"><i class="uk-icon-times-circle"></i> Files</li>
						</ul>
						
					</div>
				</div>
				
				<div class="uk-width-1-3">
					<div class="uk-panel uk-panel-box">
						<div class="uk-panel-teaser">
							<img src="{{ asset('img/sunflower-2.jpg') }}" alt"">
						</div>
						<h3 class="uk-panel-title">Plus - $19 / Month</h3>
						<ul class="uk-list">
							<li>Unlimited Work Orders</li>
							<li>Unlimited Proposals</li>
							<li>Unlimited Invoices</li>
							<li>100 Clients</li>
							<li>100 Projects</li>
							<li>10 user</li>
						</ul>
						
						<hr>
						
						<ul class="uk-list">
							<li><i class="uk-icon-check-circle"></i> Export</li>
							<li><i class="uk-icon-check-circle"></i> Reports</li>
							<li class="uk-text-muted"><i class="uk-icon-times-circle"></i> Client Portal</li>
							<li class="uk-text-muted"><i class="uk-icon-times-circle"></i> Files Storage</li>
						</ul>
						
					</div>
				</div>
				
				<div class="uk-width-1-3">
					<div class="uk-panel uk-panel-box">
						<div class="uk-panel-teaser">
							<img src="{{ asset('img/sunflower-3.jpg') }}" alt"">
						</div>
						<h3 class="uk-panel-title">Pro - $39 / Month</h3>
						<ul class="uk-list">
							<li>Unlimited Work Orders</li>
							<li>Unlimited Invoices</li>
							<li>Unlimited Proposals</li>
							<li>Unlimited Clients</li>
							<li>Unlimited Projects</li>
							<li>25 users</li>
						</ul>
						
						<hr>
						
						<ul class="uk-list">
							<li><i class="uk-icon-check-circle"></i> Export</li>
							<li><i class="uk-icon-check-circle"></i> Reports</li>
							<li class="uk-text-muted"><i class="uk-icon-times-circle"></i> Client Portal</li>
							<li class="uk-text-muted"><i class="uk-icon-times-circle"></i> Files Storage (10 GB)</li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="uk-grid uk-text-center">
				<div class="uk-width-1-1">
					<a href="{{ url('register') }}" class="uk-button trial">Decide later and try it free for 30 days</a>
				</div>
			</div>
			
		</div>	
	</div>
	
</div>

@stop