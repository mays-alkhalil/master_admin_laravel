@extends('layouts.master')

@section('title', 'Reviews')

@section('content')

<!-- Confirm Delete Modal for Reviews -->
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-labelledby="deleteReviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="deleteReviewForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteReviewModalLabel">Delete Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this review?</p>
                    <input type="hidden" name="review_delete_id" id="review_id">
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
            <h4>Reviews</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Review Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($review->user)->name ?? 'No User' }}</td> <!-- استخدام optional هنا -->
                                <td>{{ optional($review->product)->name ?? 'No Product' }}</td> <!-- استخدام optional هنا -->
                                <td>{{ $review->rating }}</td>
                                <td>{{ $review->review }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm deleteReviewBtn" data-id="{{ $review->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).on('click', '.deleteReviewBtn', function() {
    let review_id = $(this).data('id');
    let actionUrl = "{{ route('admin.reviews.destroy', ':id') }}".replace(':id', review_id);
    $('#deleteReviewForm').attr('action', actionUrl);
    $('#deleteReviewModal').modal('show');
});
</script>
@endsection
