<tr id="row-{{ $time->id }}" class="time">
    <td>{{ $time->start->format('n/j/y') }}</td>
    @if($time->time)
        <td>{{ $time->elapsedFormatted() }}</td>
    @else
        <td>Timer Going</td>
    @endif

    <td>
        <a href="#" class="edit-time" id="{{ $time->id }}" data-uk-modal>
            edit
        </a>
        <a href="" class="delete-time" id="{{ $time->id }}">
            trash
        </a>
    </td>
</tr>