@extends ('layouts.master')

@section('title', 'Category')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mt-4">Edit Category</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

         <form method="POST" action="{{ url('admin/update-category/'.$category->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"
                        rows="5">{{ $category->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <!-- @if($category->image)
                    <img src="{{ asset('uploads/categories/'.$category->image) }}" width="100px" height="100px"
                        alt="Current Image">
                    @endif -->
                </div>

                <h6>SEO Tags</h6>
                <div class="mb-3">
                    <label for="meta-title">Meta Title</label>
                    <input type="text" class="form-control" id="meta-title" name="meta_title"
                        value="{{ $category->meta_title }}">
                </div>

                <div class="mb-3">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                        value="{{ $category->meta_keyword }}" required>
                </div>

                <div class="mb-3">
                    <label for="meta-description">Meta Description</label>
                    <input type="text" class="form-control" id="meta-description" name="meta_description"
                        value="{{ $category->meta_description }}">
                </div>

                <h6>Status Mode</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="navbar_status">Navbar Status</label>
                        <input type="checkbox" id="navbar_status" name="navbar_status"
                            {{ $category->navbar_status == '1' ? 'checked' : '' }}>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" id="status" name="status"
                            {{ $category->status == '1' ? 'checked' : '' }}>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </form>

            @endsection