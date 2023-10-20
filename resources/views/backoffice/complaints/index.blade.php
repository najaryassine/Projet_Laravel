@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Complaints List</h1>


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

        <script>
            function toggleSort(column) {
                const currentUrl = new URL(window.location.href);
                const currentSort = currentUrl.searchParams.get('sort');
                const currentOrder = currentUrl.searchParams.get('order');

                if (currentSort === column) {
                    // Toggle the sorting order
                    const newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
                    currentUrl.searchParams.set('order', newOrder);
                } else {
                    // Set the new sorting column to ascending
                    currentUrl.searchParams.set('sort', column);
                    currentUrl.searchParams.set('order', 'asc');
                }

                // Redirect to the updated URL with sorting parameters
                window.location.href = currentUrl.toString();
            }
        </script>





    @if ($complaints->isEmpty())
            <p>No complaints found.</p>
        @else

            <form action="{{ route('backoffice.complaints.index') }}" method="GET" class="form-inline my-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-dark">Search</button>
                    </div>
                </div>
            </form>




            <table class="table table-bordered">
                {{--<thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Submission Date</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Actions</th>
                </tr>
                </thead>--}}


                <thead>
                <tr>
                    <th>ID</th>
                    <th><a href="{{ route('backoffice.complaints.index', ['sort' => 'subject', 'order' => $sort === 'subject' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            Subject
                        </a>
                        @if ($sort === 'subject')
                            @if ($order === 'asc')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort-down"></i>
                            @endif
                        @endif
                    </th>

                    <th><a href="{{ route('backoffice.complaints.index', ['sort' => 'description', 'order' => $sort === 'description' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            Description
                        </a>
                        @if ($sort === 'description')
                            @if ($order === 'asc')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort-down"></i>
                            @endif
                        @endif
                    </th>

                    <th><a href="{{ route('backoffice.complaints.index', ['sort' => 'submission_date', 'order' => $sort === 'submission_date' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            Submission Date
                        </a>
                        @if ($sort === 'submission_date')
                            @if ($order === 'asc')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort-down"></i>
                            @endif
                        @endif
                    </th>

                    <th><a href="{{ route('backoffice.complaints.index', ['sort' => 'status', 'order' => $sort === 'status' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            Status
                        </a>
                        @if ($sort === 'status')
                            @if ($order === 'asc')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort-down"></i>
                            @endif
                        @endif
                    </th>

                    <th><a href="{{ route('backoffice.complaints.index', ['sort' => 'priority', 'order' => $sort === 'priority' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            Priority
                        </a>
                        @if ($sort === 'priority')
                            @if ($order === 'asc')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort-down"></i>
                            @endif
                        @endif
                    </th>

                    <th>Actions</th>
                </tr>
                </thead>





                <tbody>
                @foreach ($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->id }}</td>
                        <td>{{ $complaint->subject }}</td>
                        <td>{{ $complaint->description }}</td>
                        <td>{{ $complaint->submission_date }}</td>
                        <td>{{ $complaint->status }}</td>
                        <td>{{ $complaint->priority }}</td>
                        <td>
                            <a href="{{ route('backoffice.complaints.show', $complaint->id) }}" class="btn btn-info">View</a>
                            @if (auth()->user()->role == 0) {{-- Check for admin role (assuming role "0" is for admin) --}}
                            <form action="{{ route('backoffice.complaints.destroy', $complaint->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this complaint?')">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <style>
                .pagination .page-item .page-link {
                    color: #000000;
                    background-color: white; /* Set the background color to white */
                    border: 1px solid #24bdb7; /* Set the border color to black */
                }
            </style>
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

        @endif
    </div>
@endsection


