@extends('layouts.master')

@section('title', 'Orders')

@section('content')

<!-- Confirm Delete Modal for Orders -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="deleteOrderForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOrderModalLabel">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>View Orders</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- نموذج البحث -->
            <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Search by User Name, Status, or Delivery Method" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <!-- جدول الطلبات -->
            <table id="myDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>Delivery Method</th>
                        <th>Total Amount</th>
                        <th>Items Count</th>
                        <th>Edit Status</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->delivery_method == 'delivery' ? 'Delivery' : 'Pickup' }}</td>
                        <td>${{ $order->total_amount }}</td>
                        <td>{{ $order->items->sum('quantity') }}</td>
                        <td>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                        Processing
                                    </option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>
                                        Canceled
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <!-- زر العرض -->
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm deleteOrderBtn" data-id="{{ $order->id }}"
                                data-bs-toggle="modal" data-bs-target="#deleteOrderModal">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- روابط الباجيناشن -->
            <div class="pagination">
                {!! $orders->links('pagination::bootstrap-4') !!} <!-- رابط الباجينيشن مع Bootstrap 4 -->
            </div>
        </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).on('click', '.deleteOrderBtn', function() {
    let order_id = $(this).data('id');
    let actionUrl = "{{ route('admin.orders.destroy', ':id') }}".replace(':id', order_id);
    $('#deleteOrderForm').attr('action', actionUrl);
    $('#deleteOrderModal').modal('show');
});
</script>
@endsection