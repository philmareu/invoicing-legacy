<h3 class="notes uk-panel-title">Notes</h3>
<div class="uk-panel-badge"><a href="" id="add-note" data-uk-modal>Add</a></div>

<div class="uk-grid">
    <div class="uk-width-1-1">
        @each('partials.notes.note', $notes, 'note', 'partials.notes.none')
    </div>
</div>