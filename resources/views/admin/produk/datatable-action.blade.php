<a href="{{ route('dashboard.kategoris.edit', $id_produk) }}" class="btn btn-success btn-sm">Edit</a>

<form action="{{ route('dashboard.kategoris.destory', $id_produk) }}" method="post" class="d-inline">
    @csrf
    @method('delete')
    <button class="btn btn-danger btn-sm" onclick="deleteData(event)">Delete</button>
</form>
