<a href="{{ route('dashboard.admins.edit', $id) }}" class="btn btn-success btn-sm">Edit</a>


@if ($id !== auth()->user()->id)
    <form action="{{ route('dashboard.admins.destory', $id) }}" method="post" class="d-inline">
        @csrf
        @method('delete')
        <button class="btn btn-danger btn-sm" onclick="deleteData(event)">Delete</button>
    </form>
@endif
