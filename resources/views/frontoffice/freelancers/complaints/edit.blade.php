@extends('frontoffice.layouts.user_type.auth')

@section('content')
    <h1>Edit Complaint</h1>

    <form action="{{ route('frontoffice.freelancers.complaints.update', $complaint->id) }}" method="POST">
        @csrf
        @method('PUT')

        <table class="table">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Subject:</td>
                <td><input type="text" name="subject" value="{{ $complaint->subject }}" required></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name="description" rows="4" required>{{ $complaint->description }}</textarea></td>
            </tr>
            <tr>
                <td>Submission Date:</td>
                <td>{{ $complaint->submission_date }}</td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>{{ $complaint->status }}</td>
            </tr>
            <tr>
                <td>Priority:</td>
                <td>{{ $complaint->priority }}</td>
            </tr>
        </table>

        <button type="submit" class="btn btn-primary">Update Complaint</button>
    </form>

    <a href="{{ route('frontoffice.freelancers.complaints.show', $complaint->id) }}" class="btn btn-secondary">Back to Complaint Details</a>
    </section>
