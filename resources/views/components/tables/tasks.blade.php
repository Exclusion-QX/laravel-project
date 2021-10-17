<tr>
    <td>
        {{ $id }}
    </td>
    <td>
        <a href="{{ route('tasks.show', $id) }}">{{ $title }}</a>
    </td>
    <td>
        {{ mb_substr($description, 0, 200) }}
    </td>
    <td class="text-center">
        {{ $created }}
    </td>
    <td class="text-center">
        {{ $deadline }}
    </td>
    <td class="text-center">
        {{ $priority }}
    </td>
    <td class="text-center">
        {{ $status }}
    </td>
    <td class="project-actions text-right">
        <a class="btn btn-info btn-sm" href="{{ route('tasks.edit', $id) }}">
            <i class="fas fa-pencil-alt">
            </i>
            Редактировать
        </a>
        <form action="{{ route('tasks.destroy', $id) }}" method="POST" style="display:inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm delete-task-btn">
                <i class="fas fa-trash">
                </i>
                Удалить
            </button>
        </form>
    </td>
</tr>

