@extends('layouts.master')

@section('title', 'Category')
@section('content')
<!-- confirm delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ url('admin/delete-category') }}" method="POST">
    @csrf
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="category_delete_id" id="category_id">
        <h5>Are You Sure To Delete This Category?</h5>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
    </div>
    </form>
    </div>
  </div>
</div>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>View Category
                <a href="{{ url('admin/add-category') }}" class="btn btn-primary btn-sm float-end">Add Category</a>
            </h4>
        </div>

        <div class="card-body">

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- إضافة خاصية البحث عبر الرابط -->
            <div class="mb-3">
                <form action="{{ url('admin/categories') }}" method="GET" class="d-flex justify-content-between">
                    <input type="text" name="search" class="form-control" placeholder="Search by Category Name" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form>
            </div>

            <div class="table-responsive">
                <table id="myDataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td><img src="{{ asset('uploads/categories/'.$item->image) }}" width="50px" height="50px" alt="Img"></td>
                                <td>{{ $item->status == '1' ? 'Hidden' : 'Shown' }}</td>
                                <td><a href="{{ url('admin/edit-category/'.$item->id) }}" class="btn btn-success btn-sm">Edit</a></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm deleteCategoryBtn" value="{{ $item->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- روابط الباجينيشن -->
            <div class="pagination">
                {!! $categories->appends(['search' => request('search')])->links('pagination::bootstrap-4') !!}
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $(document).on('click', '.deleteCategoryBtn', function(e){
        e.preventDefault(); 
        var category_id = $(this).val(); 
        $('#category_id').val(category_id);
        $('#deleteModal').modal('show');
    });
});
</script>
@endsection
