<a href="{{ route('dashboard.suppliers.edit', $id_supplier) }}" class="btn btn-success btn-sm">Edit</a>

<form action="{{ route('dashboard.suppliers.destory', $id_supplier) }}" method="post" class="d-inline">
    @csrf
    @method('delete')
    <button class="btn btn-danger btn-sm" onclick="deleteData(event)">Delete</button>
</form>
