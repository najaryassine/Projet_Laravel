@extends('frontoffice.layouts.user_type.auth')

@section('content')
    <div class="container" style="margin-top: 200px;">
        <h1>Create Complaint</h1>

        <form action="{{ route('frontoffice.freelancers.complaints.store') }}" method="POST">
            @csrf

            <table class="table">
                <tr>
                    <th><label for="subject">Subject:</label></th>
                    <td><input type="text" name="subject" id="subject" required class="form-control"></td>
                </tr>
                <tr>
                    <th><label for="description">Description:</label></th>
                    <td><textarea name="description" id="description" required class="form-control"></textarea></td>
                </tr>
                <tr>
                    <th><label for="submission_date">Submission Date:</label></th>
                    <td><input type="hidden" name="submission_date" id="submission_date" value="{{ date('Y-m-d') }}" class="form-control"></td>
                </tr>
                <tr>
                    <th><label for="status">Status:</label></th>
                    <td><input type="hidden" name="status" id="status" value="Non Treated" class="form-control"></td>
                </tr>
                <tr>
                    <th><label for="priority">Priority:</label></th>
                    <td>
                        <select name="priority" id="priority" required class="form-control">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </td>
                </tr>
            </table>

            <button type="submit" class="btn btn-primary">Create Complaint</button>
        </form>

        <a href="{{ route('frontoffice.freelancers.complaints.index') }}" class="btn btn-secondary mt-3">Back to Complaints</a>
    </div>
@endsection









