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

                

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </form>

            @endsection