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
                            <h5 class="mb-0">All Comments</h5>
                        </div>
                        <a href="/comments/add" class="btn bg-gradient-primary btn-sm mb-0" type="button">+ New Comment</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        article_Id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Body
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Created At
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $comment->id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $comment->article_id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $comment->body }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $comment->created_at }}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('/comments/edit' . $comment->id ) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit comment">                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" style="display: inline;" onsubmit="confirmation(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent p-0" data-bs-toggle="tooltip" data-bs-original-title="Delete Comment">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination">
                    {{ $comments->links() }}
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
            title: "Are you sure to Delete this Article",
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
