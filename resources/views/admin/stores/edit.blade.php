@extends('layouts.master')

@section('title', 'Edit Store')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mt-4">Edit Store</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('admin.stores.update', $store->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Store Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $store->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address">Store Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $store->address) }}">
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $store->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image">Store Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($store->image)
                    <img src="{{ asset('storage/'.$store->image) }}" width="100px" height="100px" alt="Current Image">
                    @endif
                </div>

                <!-- <h6>SEO Tags</h6>
                <div class="mb-3">
                    <label for="meta-title">Meta Title</label>
                    <input type="text" class="form-control" id="meta-title" name="meta_title" value="{{ old('meta_title', $store->meta_title) }}">
                </div>

                <div class="mb-3">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $store->meta_keywords) }}">
                </div>

                <div class="mb-3">
                    <label for="meta-description">Meta Description</label>
                    <input type="text" class="form-control" id="meta-description" name="meta_description" value="{{ old('meta_description', $store->meta_description) }}">
                </div> -->

                <!-- <h6>Status Mode</h6> -->
                <div class="row">
                    <!-- <div class="col-md-3 mb-3">
                        <label for="navbar_status">Navbar Status</label>
                        <input type="checkbox" id="navbar_status" name="navbar_status" {{ old('navbar_status', $store->navbar_status) == '1' ? 'checked' : '' }}>
                    </div> -->

                    <!-- <div class="col-md-3 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" id="status" name="status" {{ old('status', $store->status) == '1' ? 'checked' : '' }}>
                    </div> -->

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Store</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
