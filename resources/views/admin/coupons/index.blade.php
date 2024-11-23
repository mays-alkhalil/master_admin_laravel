@extends('layouts.master')

@section('title', 'Coupons')

@section('content')

<!-- Confirm Delete Modal for Coupons -->
<div class="modal fade" id="deleteCouponModal" tabindex="-1" aria-labelledby="deleteCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="deleteCouponForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCouponModalLabel">Delete Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this coupon?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="container mt-4">
        <h4 class="mb-4">Coupons</h4>
        
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary mb-3">Add Coupon</a>
        
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td class="text-center">{{ $coupon->id }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td class="text-center">{{ $coupon->discount }}%</td>
                        <td class="text-center">
                            @if($coupon->expires_at)
                                {{ \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d') }}
                            @else
                                <span class="text-muted">No expiration date set</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $coupon->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <!-- Trigger the modal with the delete button -->
                            <button class="btn btn-danger btn-sm deleteCouponBtn" data-id="{{ $coupon->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @section('scripts')
    <script>
        $(document).on('click', '.deleteCouponBtn', function() {
            let coupon_id = $(this).data('id');  // Get the coupon ID from the data-id attribute
            let actionUrl = "{{ route('admin.coupons.destroy', ':id') }}".replace(':id', coupon_id);  // Set the correct delete URL
            $('#deleteCouponForm').attr('action', actionUrl);  // Update the form action to point to the correct route
            $('#deleteCouponModal').modal('show');  // Show the modal
        });
    </script>
    @endsection
@endsection
