@extends('layouts.master')

@section('title', 'Contact Messages')

@section('content')

<!-- Confirm Delete Modal for Messages -->
<div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteMessageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" id="deleteMessageForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMessageModalLabel">Delete Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this message?</p>
                    <input type="hidden" name="message_delete_id" id="message_id">
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
            <h4>Contact Messages</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Table -->
            <div class="table-responsive">
                <table id="myDataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->message }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm deleteMessageBtn"
                                        data-id="{{ $contact->id }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteMessageModal">
                                        Delete
                                    </button>
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
$(document).on('click', '.deleteMessageBtn', function() {
    let message_id = $(this).data('id');
    let actionUrl = "{{ route('admin.contacts.destroy', ':id') }}".replace(':id', message_id);
    $('#deleteMessageForm').attr('action', actionUrl);
    $('#deleteMessageModal').modal('show');
});
</script>

@endsection
