@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Tasks :				
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Tasks</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div class="container col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Tasks List :</h1>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="col-lg-12 post-list">
                <div class="container-fluid py-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">{{ __('Liste des tâches') }}</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            @if(session('success'))
                                <!-- Add your success message alert here -->
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                
                            <ul>
                                @foreach($tasks as $task)
                                    <li>
                                        <h4>{{ $task->title }}</h4>
                                        <p>Status: {{ $task->status }}</p>
                                        <a class="genric-btn primary-border circle" href="{{ route('tasks.show', ['id' => $task->id]) }}">View</a>
                                    </li>
                                @endforeach
                            </ul>
                
                            <div>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>


</section>


<script>
    function confirmation(ev) {
        ev.preventDefault();
        var form = ev.currentTarget;
        var urlToSubmit = form.getAttribute('action');

        swal({
            title: "Are you sure to Cancel this Contract",
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
