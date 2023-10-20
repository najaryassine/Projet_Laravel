@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Create Complaint</h1>

        <form action="{{ route('backoffice.complaints.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="submission_date">Submission Date:</label>
                <input type="date" name="submission_date" id="submission_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" name="status" id="status" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="text" name="priority" id="priority" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Complaint</button>
        </form>
    </div>
@endsection
