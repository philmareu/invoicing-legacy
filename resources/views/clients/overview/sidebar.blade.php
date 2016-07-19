	


<div class="uk-panel uk-panel-box">

	<h3 class="uk-panel-title">Recent Activity</h3>
	
	<div class="uk-grid">
		<div class="uk-width-1-1">

	@if(count($activities))
	
	<ul class="uk-list">
		@foreach($activities as $activity)
		<li>{{ displayActivity($activity, true) }}</li>
		@endforeach
	</ul>

	@else

		<p class="uk-text-muted">There is no recent client activity.</p>

	@endif

</div>

</div>
</di>