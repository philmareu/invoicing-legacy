<div class="note">
	<h4>{{ icon('scheduled') }} {{ $note->created_at->toDayDateTimeString() }}</h4>
	<blockquote>
		<p>{{ $note->note }}</p>
		<small>{{ displayName($note->user) }}</small>
	</blockquote>
</div>