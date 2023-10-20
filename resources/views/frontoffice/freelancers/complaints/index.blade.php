@extends('frontoffice.layouts.user_type.auth')
@extends('layouts.app')

@section('content')


    <script>
        // Function to remove sorting parameters from the URL
        function removeSortingParameters() {
            const url = new URL(window.location.href);

            if (url.searchParams.get('sort') || url.searchParams.get('order')) {
                url.searchParams.delete('sort');
                url.searchParams.delete('order');

                // Replace the URL without sorting parameters
                window.history.replaceState({}, document.title, url.toString());
            }
        }

        // Call the function when the page loads
        window.addEventListener('load', removeSortingParameters);
    </script>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search').on('input', function () {
                const searchQuery = $(this).val().toLowerCase();

                // Show all rows initially
                $('.complaint-row').show();

                if (searchQuery === '') {
                    return;
                }

                // Filter rows based on search query
                $('.complaint-row').each(function () {
                    const complaint = $(this);
                    const subject = complaint.find('.complaint-subject').text().toLowerCase();
                    const description = complaint.find('.complaint-description').text().toLowerCase();
                    const matches = subject.includes(searchQuery) || description.includes(searchQuery);
                    complaint.toggle(!matches);
                });
            });
        });
    </script>











    <div class="container" style="margin-top: 250px;">

        <div class="d-flex justify-content-between">
            <h1 style="display: inline;">Complaints</h1>
            <form action="{{ route('frontoffice.freelancers.complaints.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search..." autofocus>
                </div>
            </form>
            <a href="{{ route('frontoffice.freelancers.complaints.create') }}" class="btn btn-primary">Add Complaint</a>
        </div>


        @if ($complaints->isEmpty())
            <p>No complaints found.</p>
        @else
            <div class="table-responsive" style="margin-top: 20px;">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><a href="{{ route('frontoffice.freelancers.complaints.index', ['sort' => 'subject', 'order' => $sort === 'subject' && $order === 'asc' ? 'desc' : 'asc']) }}">Subject</a></th>
                        <th><a href="{{ route('frontoffice.freelancers.complaints.index', ['sort' => 'submission_date', 'order' => $sort === 'submission_date' && $order === 'asc' ? 'desc' : 'asc']) }}">Submission Date</a></th>
                        <th><a href="{{ route('frontoffice.freelancers.complaints.index', ['sort' => 'status', 'order' => $sort === 'status' && $order === 'asc' ? 'desc' : 'asc']) }}">Status</a></th>
                        <th><a href="{{ route('frontoffice.freelancers.complaints.index', ['sort' => 'priority', 'order' => $sort === 'priority' && $order === 'asc' ? 'desc' : 'asc']) }}">Priority</a></th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->subject }}</td>
                            <td>{{ $complaint->submission_date }}</td>
                            <td>{{ $complaint->status }}</td>
                            <td>{{ $complaint->priority }}</td>
                            <td>
                                <a href="{{ route('frontoffice.freelancers.complaints.show', $complaint->id) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12 col-md-5">
                {{ $complaints->appends(['sort' => $sort, 'order' => $order])->links('pagination::bootstrap-4') }}
            </div>
            <div class="col-sm-12 col-md-7 text-right">
                <p class="text-muted">
                    Showing {{ $complaints->firstItem() }} to {{ $complaints->lastItem() }} of {{ $complaints->total() }} results
                </p>
            </div>
        </div>
    </div>
@endsection



