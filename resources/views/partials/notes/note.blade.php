<div class="note">
    <h4><i class="uk-icon-calendar"></i> {{ $note->created_at->toDayDateTimeString() }}</h4>
    <blockquote>
        <p>{{ $note->note }}</p>
    </blockquote>
</div>