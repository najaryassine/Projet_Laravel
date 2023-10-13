@extends('layouts.user_type.auth')

@section('content')

<div>
    @if(session('success'))
    <div class="m-3 alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
        <span class="alert-text text-white">
            {{ session('success') }}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, 2000);
    </script>
    @endif    

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All contracts</h5>
                        </div>
                        <a href="/contracts/add" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New contract</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        #
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                       Project Title
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Client Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Freelancer Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Created At
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $contract)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $contract->project->title }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $contract->client->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $contract->freelancer->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            @if ($contract->status == 'pending')
                                                <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                            @elseif ($contract->status == 'accepted')
                                                <span class="badge badge-sm bg-gradient-success">Accepted</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">Rejected</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($contract->created_at)->format('Y F d') }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            {{-- <a href="{{ route('contracts.show1', $contract->id) }}" class="btn btn-link btn-sm">
                                                <i class="fa fa-eye me-2"></i>Show
                                            </a> --}}
                                            <a href="{{ route('contracts.edit1', $contract->id) }}" class="btn btn-link btn-sm">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                            <form action="{{ route('contracts.destroy1', $contract->id) }}" method="POST" onsubmit="confirmation(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link btn-sm" >
                                                    <i class="fas fa-trash-alt me-2"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {{ $contracts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmation(ev) {
        ev.preventDefault();
        var form = ev.currentTarget;
        var urlToSubmit = form.getAttribute('action');

        swal({
            title: "Are you sure to Delete this Contract",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    }
</script>
@endsection