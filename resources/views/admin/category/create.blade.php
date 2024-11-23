@extends ('layouts.master')

@section('title', 'Category')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mt-4">Add Category</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ url('admin/add-category') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <!-- <div class="mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" required>
                </div> -->

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>

                <!-- <h6>SEO Tags</h6>
                <div class="mb-3">
                    <label for="meta-title">Meta Title</label>
                    <input type="text" class="form-control" id="meta-title" name="meta_title">
                </div>

                <div class="mb-3">
    <label for="meta_keywords">Meta Keywords</label>
    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" required> -->
</div>

                <!-- <div class="mb-3">
                    <label for="meta-description">Meta Description</label>
                    <input type="text" class="form-control" id="meta-description" name="meta_description">
                </div>

                <h6>Status Mode</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="navbar_status">Navbar Status</label>
                        <input type="checkbox" id="navbar_status" name="navbar_status">
                    </div> -->

                    <!-- <div class="col-md-3 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" id="status" name="status">
                    </div> -->

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
