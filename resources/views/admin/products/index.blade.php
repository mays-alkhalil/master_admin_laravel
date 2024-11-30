@extends('layouts.master')

@section('title', 'Products')

@section('content')

<!-- Confirm Delete Modal for Products -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" id="deleteProductForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <input type="hidden" name="product_delete_id" id="product_id">
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
            <h4>View Products
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm float-end">Add Product</a>
            </h4>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- نموذج البحث -->
            <form action="{{ route('admin.products.index') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Search by Name or Category" value="{{ request('search') }}">
                    </div>
                    <div class="col-12 col-sm-4 col-md-6">
                        <button type="submit" class="btn btn-primary w-100 w-sm-auto">Search</button>
                    </div>
                </div>
            </form>

            <!-- جدول المنتجات -->
            <div class="table-responsive">
                <table id="myDataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>${{ $product->price }}</td>
                            <td>
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="50px" height="50px" alt="Product Image">
                                @else
                                <span>No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success btn-sm">Edit</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm deleteProductBtn" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- روابط الباجيناشن -->
            <div class="pagination">
                {!! $products->links('pagination::bootstrap-4') !!} <!-- رابط الباجينيشن مع Bootstrap 4 -->
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).on('click', '.deleteProductBtn', function() {
    let product_id = $(this).data('id');
    let actionUrl = "{{ route('admin.products.destroy', ':id') }}".replace(':id', product_id);
    console.log('Opening modal for product ID:', product_id); // تحقق من الوصول إلى الكود
    $('#deleteProductForm').attr('action', actionUrl);
    $('#deleteProductModal').modal('show');
});
</script>
@endsection
