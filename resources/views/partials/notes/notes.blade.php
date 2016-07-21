<h3 class="notes uk-panel-title">
    Notes
    <a href="" id="add-note" data-uk-modal>
        +
    </a>
</h3>

<div id="notes">
    @each('partials.notes.note', $notes, 'note', 'partials.notes.none')
</div>