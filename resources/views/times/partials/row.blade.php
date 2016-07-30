<tr id="row-{{ $time->id }}" class="time">
    <td>{{ $time->start->format('n/j/y') }}</td>
    <td>{{ $time->elapsedFormatted() }}</td>

    <td>
        <a href="#" class="edit-time" id="{{ $time->id }}" data-uk-modal><i class="uk-icon-pencil-square-o"></i></a>
        <a href="" class="delete-time" id="{{ $time->id }}"><i class="uk-icon-trash"></i></a>
    </td>
</tr>