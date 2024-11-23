@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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

                    @if(auth()->user()->role == 0) <!-- تحقق إذا كان المستخدم دور يوزر -->
                        <p>{{ __('You are logged in as a user. You cannot access the Admin Dashboard.') }}</p>
<div class="d-flex justify-content-center align-items-center" style="height: 300px; ">
    <img src="{{ asset('assets/imgs/user.png') }}" alt="User Image">
</div>
                        @else
                        <p>{{ __('You are logged in as an administrator.') }}</p>
                    @endif
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
