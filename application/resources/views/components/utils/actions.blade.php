<div class="btn-group">
    <a href="{{ route($module . '.edit', [$moduleSingle => $item->id]) }}" class="btn btn-info">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <form data-action="{{ route($module . '.destroy', [$moduleSingle => $item->id]) }}" class="delete_entity">
        @csrf
        <button type="submit" class="btn btn-danger rounded-start-0">
            <i class="fas fa-times"></i>
        </button>
    </form>
</div>
