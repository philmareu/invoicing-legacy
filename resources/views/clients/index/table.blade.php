<table class="uk-table uk-table-striped uk-table-condensed">
    <thead>
        <tr>
            <th>Title</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
        @each('clients.index.row', $clients, 'client', 'clients.index.none')
    </tbody>
</table>