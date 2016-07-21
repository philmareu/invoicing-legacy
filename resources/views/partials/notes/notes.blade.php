<h3 class="notes uk-panel-title">
    Notes
    <a href="" id="add-note" data-uk-modal>
        +
    </a>
</h3>

<div class="uk-grid">
    <div class="uk-width-1-1">
        <div id="notes">
            @each('partials.notes.note', $notes, 'note', 'partials.notes.none')
        </div>
    </div>
</div>