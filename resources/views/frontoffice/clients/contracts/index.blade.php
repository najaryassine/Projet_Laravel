@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Contracts :				
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Contracts</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div class="container col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Your Contracts List :</h1>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="col-lg-12 post-list">
                @if(session('success'))
                 <script>
                     document.addEventListener('DOMContentLoaded', function () {
                     swal({icon: 'success',title: 'Success',text: '{{ session('success') }}',
                     showConfirmButton: false,timer: 3500});
                    });
                 </script>
                @endif 
            
                @foreach ($contracts as $contract)
                    <div class="single-post d-flex flex-row">
                        <div class="details">
                            <div class="title d-flex flex-row justify-content-between">
                                <div class="titles">
                                    <h4>Contract Number : &#10149;{{ $contract->id }}</h4>
                                    <h4>Project Title : {{ $contract->project->title }}</h4>
                                </div>
                                <ul class="btns" style="padding-left: 50px;">
                                        <a class="genric-btn success-border circle" 
                                        href="{{ route('projects.show1', ['id' => $contract->project_id]) }}"
                                        >View Project
                                            <span class="lnr lnr-arrow-right"></span>
                                        </a>
                                </ul>
                            </div>
                            <p>
                                Made By {{ $contract->client->name }}
                            </p>
                            <h5>
                                @if ($contract->status == 'accepted')
                                    <span style="color: green; font-size: 30px;">Accepted</span>
                                @elseif ($contract->status == 'pending')
                                <span style="color: #FFF000;; font-size: 30px;">Pending</span>
                                @else
                                    <span style="color: #Ff0000; font-size: 30px;">Declined</span>
                                @endif
                            </h5>
                            <p class="address"><span class="lnr lnr-map"></span> Project Cost : {{ intval($contract->project_cost) }} $</p>
                            <p class="address"><span class="lnr lnr-date"></span> Updated on {{ $contract->updated_at->format('d F Y') }}</p>
                            @if (auth()->user()->role == 2)

                                @if ($contract->status == 'pending')
                            
                                        <form action="{{ route('contracts.destroy0', $contract->id) }}" method="POST" onsubmit="confirmation(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button class="genric-btn danger-border circle" type="submit"
                                        >
                                            <span class="lnr lnr-arrow-right">Cancel Contract</span>
                                        </button>
                                        </form>            
                                        
                                @endif   
                            
                            @else
                                @if ($contract->status == 'pending')

                                    <a class="genric-btn success-border circle" 
                                        {{-- href="{{ route('projects.show1', ['id' => $contract->project_id]) }}" --}}
                                        >
                                            <span class="lnr lnr-arrow-right">Accept</span>
                                    </a>
                                    <a class="genric-btn danger-border circle" 
                                        {{-- href="{{ route('projects.show1', ['id' => $contract->project_id]) }}" --}}
                                        >
                                            <span class="lnr lnr-arrow-right">Decline</span>
                                    </a>
                                @endif   

                            @endif   

                        </div>
                    </div>
                @endforeach
            
                @if ($contracts->hasPages())
                    <div class="row">
                        @if ($contracts->onFirstPage())
                            <a class="text-uppercase loadmore-btn mx-auto d-block">Previous</a>
                        @else
                            <a class="text-uppercase loadmore-btn mx-auto d-block" href="{{ $contracts->previousPageUrl() }}">Previous</a>
                        @endif
            
                        @if ($contracts->hasMorePages())
                            <a class="text-uppercase loadmore-btn mx-auto d-block" href="{{ $contracts->nextPageUrl() }}">Next</a>
                        @else
                            <a class="text-uppercase loadmore-btn mx-auto d-block">Next</a>
                        @endif
                    </div>
                @endif
                <div style="padding: 20px;">
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