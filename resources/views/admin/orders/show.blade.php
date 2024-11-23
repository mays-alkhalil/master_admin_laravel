@extends('layouts.master')

@section('title', 'Order Details')

@section('content')
<div class="container mt-4">
    <h4>Order Details</h4>
    <div class="card">
        <div class="card-header">
            <h5>Order #{{ $order->id }}</h5>
            <p>User: {{ $order->user->name }}</p>
            <p>Status: {{ $order->status }}</p>
            <p>Total Amount: ${{ $order->total_amount }}</p>
        </div>
        <div class="card-body">
            <h5>Items:</h5>
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>${{ $item->unit_price }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ $item->total_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>
</div>
@endsection
