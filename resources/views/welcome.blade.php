@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if(session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if(session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h4>{{ __('Welcome to the Admin Dashboard!') }}</h4>
                    <p>{{ __('If you want to access the Admin Dashboard, please log in.') }}</p>
                    <div class="d-flex justify-content-center align-items-center" style="height: 300px; ">
    <img src="{{ asset('assets/imgs/admin.png') }}" alt="User Image">
</div>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
