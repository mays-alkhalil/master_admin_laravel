@extends ('layouts.master')

@section('title', 'Edit Users')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mt-4">Edit Users</h4>
            <a href="{{ url('admin/users') }}" class="btn btn-danger float-end">Back</a>
        </div>
        <div class="card-body">

            <!-- @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif -->

       

                <div class="mb-3">
                    <label>Full Name</label>
                    <p class="form-control">{{$user->name}}</p>
                    
                </div>


                <div class="mb-3">
                    <label>Email Id</label>
                    <p class="form-control">{{$user->email}}</p>
                    
                </div>


                <div class="mb-3">
                    <label>Created At</label>
                    <p class="form-control">{{$user->created_at->format('d/m/y') }}</p>
                    
                </div>


                <form method="POST" action="{{ url('admin/update-user/'.$user->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Role as</label>
                    <select class="form-control" name="role_as">
                        <option value="1" {{$user->role_as == '1'? 'selected':''}}>Admin</option>
                        <option value="0" {{$user->role_as == '0'? 'selected':''}}>User</option>
                    </select>
                    
                </div>




                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update user</button>
                    </div>
                </div>
            </form>

            @endsection