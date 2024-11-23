@extends('layouts.master')

@section('title', 'Add Coupon')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Add New Coupon</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="code" class="form-label">Coupon Code</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                </div>

                <div class="mb-3">
                    <label for="discount" class="form-label">Discount Amount (%)</label>
                    <input type="number" class="form-control" id="discount" name="discount" required>
                </div>

                <div class="mb-3">
    <label for="expires_at" class="form-label">Expiration Date</label>
    <input type="date" class="form-control" id="expires_at" name="expires_at" required>
</div>
                <button type="submit" class="btn btn-primary">Save Coupon</button>
            </form>
        </div>
    </div>
</div>

@endsection
