@extends('layouts.master')

@section('title', 'Stores')

@section('content')
<!-- Confirm Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Store</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this store?</p>
                    <input type="hidden" name="store_delete_id" id="store_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>
                View Stores
                <a href="{{ route('admin.stores.create') }}" class="btn btn-primary btn-sm float-end">Add Store</a>
            </h4>
        </div>

        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- نموذج البحث -->
            <form action="{{ route('admin.stores.index') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Search by Name or Address" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <!-- جدول المتاجر -->
            <div class="table-responsive">
                <table id="myDataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Store Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" width="50px" height="50px" alt="Store Image">
                                @else
                                <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $item->status == 'active' ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('admin.stores.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                            </td>
                            <td>
                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm deleteStoreBtn" data-id="{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- روابط الباجيناشن -->
            <div class="pagination">
                {!! $stores->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // When the delete button is clicked, set the action URL for the form
    $(document).on('click', '.deleteStoreBtn', function() {
        let store_id = $(this).data('id');
        let actionUrl = "{{ route('admin.stores.destroy', ':id') }}".replace(':id', store_id);
        $('#deleteForm').attr('action', actionUrl);
        $('#deleteModal').modal('show');
    });
});
</script>
@endsection
