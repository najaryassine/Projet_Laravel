@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Edit Complaint</h1>

        <form action="{{ route('backoffice.complaints.update', $complaint->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>Subject:</th>
                    <td>
                        <input type="text" name="subject" id="subject" class="form-control" value="{{ $complaint->subject }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>
                        <textarea name="description" id="description" class="form-control" readonly>{{ $complaint->description }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>Submission Date:</th>
                    <td>
                        <input type="date" name="submission_date" id="submission_date" class="form-control" value="{{ $complaint->submission_date }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        @if (auth()->user()->role == 0) {{-- Check for admin role (assuming role "0" is for admin) --}}
                        <select name="status" id="status" class="form-control" required>
                            <option value="Non Treated" {{ $complaint->status === 'Non Treated' ? 'selected' : '' }}>Non Treated</option>
                            <option value="Treated" {{ $complaint->status === 'Treated' ? 'selected' : '' }}>Treated</option>
                        </select>
                        @else
                            <input type="text" name="status" id="status" class="form-control" value="{{ $complaint->status }}" readonly>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Priority:</th>
                    <td>
                        <input type="text" name="priority" id="priority" class="form-control" value="{{ $complaint->priority }}" readonly>
                    </td>
                </tr>
                </tbody>
            </table>

            @if (auth()->user()->role == 0) {{-- Check for admin role (assuming role "0" is for admin) --}}
            <button type="submit" class="btn btn-primary">Update Complaint</button>
            @endif

            <a href="{{ route('backoffice.complaints.show', $complaint->id) }}" class="btn btn-secondary">View Complaint</a>
        </form>
    </div>
@endsection
