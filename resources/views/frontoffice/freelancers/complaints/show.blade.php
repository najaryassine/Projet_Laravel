@extends('frontoffice.layouts.user_type.auth')
@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 250px;">
        <h1 class="mb-4">Complaint Details</h1>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Subject</th>
                <td>{{ $complaint->subject }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $complaint->description }}</td>
            </tr>
            <tr>
                <th>Submission Date</th>
                <td>{{ $complaint->submission_date }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $complaint->status }}</td>
            </tr>
            <tr>
                <th>Priority</th>
                <td>{{ $complaint->priority }}</td>
            </tr>
            </tbody>
        </table>

        <div class="text-center">
            @if ($complaint->status !== 'Treated')
                <a href="{{ route('frontoffice.freelancers.complaints.edit', $complaint->id) }}" class="btn btn-warning">Edit Complaint</a>
                <span style="margin: 10px;"></span> <!-- Add space between buttons -->
            @endif
            <a href="{{ route('frontoffice.freelancers.complaints.index') }}" class="btn btn-secondary">Return to Complaints</a>
            <span style="margin: 10px;"></span> <!-- Add space between buttons -->
            <a href="{{ route('frontoffice.freelancers.complaints.pdf', $complaint) }}" class="btn btn-primary">Export PDF</a>
        </div>
    </div>
@endsection


