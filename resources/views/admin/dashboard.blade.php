@extends ('layouts.master')

@section('title', ' Dashboard')
@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <!-- Total Users -->
        <div class="col">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-container rounded-circle bg-light text-danger d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div>Total Users</div>
                        <h4>{{$users}}</h4>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{url('admin/users')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Stores -->
        <div class="col">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-container rounded-circle bg-light text-primary d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-store"></i>
                    </div>
                    <div>
                        <div>Total Stores</div>
                        <h4>{{$stores}}</h4>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{url('admin/category')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-container rounded-circle bg-light text-warning d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-box"></i>
                    </div>
                    <div>
                        <div>Total Products</div>
                        <h4>{{$products}}</h4>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{url('admin/products')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col">
            <div class="card bg-info text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-container rounded-circle bg-light text-info d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div>
                        <div>Total Orders</div>
                        <h4>{{$orders}}</h4>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{url('admin/orders')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')

@endsection

