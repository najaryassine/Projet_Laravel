@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Complaint Details</h1>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>ID:</th>
                <td>{{ $complaint->id }}</td>
            </tr>
            <tr>
                <th>Subject:</th>
                <td>{{ $complaint->subject }}</td>
            </tr>
            <tr>
                <th>Description:</th>
                <td>{{ $complaint->description }}</td>
            </tr>
            <tr>
                <th>Submission Date:</th>
                <td>{{ $complaint->submission_date }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>{{ $complaint->status }}</td>
            </tr>
            <tr>
                <th>Priority:</th>
                <td>{{ $complaint->priority }}</td>
            </tr>
            </tbody>
        </table>

        <a href="{{ route('backoffice.complaints.index') }}" class="btn btn-primary">Return to Complaints</a>
        <a href="{{ route('backoffice.complaints.edit', $complaint->id) }}" class="btn btn-warning">Edit Complaint</a>
    </div>
@endsection
