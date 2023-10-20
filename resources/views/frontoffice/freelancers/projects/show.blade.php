@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative">	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Projects Details :				
                </h1>	
                <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a>Projects Details</a></p>
            </div>											
        </div>
    </div>
</section>

<section class="blog-posts-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 post-list blog-post-list">
                <div class="single-post">
                    <div class="thumb">
                        <img src="{{ asset('storage/assets/img/' . $project->image) }}" alt="{{ $project->title }}" height="345" width="545">
                        <ul class="tags">
                            <li>
                                <a href="#">{{ $project->category }}</a>
                            </li>
                        </ul>
                    </div>
                    <a href="#">
                        <h1>{{ $project->title }}</h1>
                    </a>
                    <div class="content-wrap">
                        <p>{{ $project->description }}</p>
                        <p class="address"><span class="lnr lnr-map"></span> {{ $project->required_skills }}</p>
                        <p class="address"><span class="lnr lnr-database"></span> {{ $project->cost }} $</p>
                        <p class="address"><span class="lnr lnr-date"></span>Published on {{ $project->created_at->format('d F Y') }}</p>								
                    </div>
                    <h5>
                        @if ($project->status == 'completed')
                        <h4><span style="color: green">Completed</span></h4>
                        @else
                        <h4><span style="color: #FFF000;">Not Completed</span></h4>
                        @endif

                    </h5>
                    <div class="mt-10 alert-msg" style="text-align: left;"></div>

                    <div class="bottom-meta">
                        <div class="user-details row align-items-center">
                            <div class="comment-wrap col-lg-6 col-sm-6">
                                <ul>
                                @if (auth()->user()->role == 1)
                                    @if (auth()->user()->id == $project->client_id)
                                    <a class="genric-btn primary-border circle "  href="{{ route('projects.edit1', [ 'id' => $project->id])}}">Modify</a>
                                    <form 
                                    action="{{ route('projects.destroy0', $project->id) }}"
                                    method="POST" onsubmit="confirmation(event)" style="display: inline;">
                                     @csrf
                                     @method('DELETE')
                                        <button class="genric-btn danger-border circle" type="submit">
                                         <span class="lnr lnr-arrow-right">Delete</span>
                                        </button>
                                    </form>
                                    @endif

    
                                @elseif (auth()->user()->role == 2)

                                @if (in_array($project->id, $appliedContracts->pluck('project_id')->toArray()))
                                    <a class="genric-btn primary-border circle disable" disabled>Already Applied</a>
                                @else
                                    <a href="{{ route('apply.contract', ['userId' => Auth::user()->id, 'projectId' => $project->id, 'cost' => intval($project->cost), 'clientId' => $project->client_id]) }}" class="genric-btn primary-border circle">Apply Contract
                                        <span class="lnr lnr-arrow-right"></span>
                                    </a>
                                @endif
                            @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>                         
            </div>
            <div class="col-lg-4 sidebar">
                <div class="single-widget search-widget">
                    <form class="example" action="#" style="margin:auto;max-width:300px">
                      <input type="text" placeholder="Search Projects" name="search2">
                      <button type="submit"><i class="fa fa-search"></i></button>
                    </form>								
                </div>

                <div class="single-widget protfolio-widget">
                    <a href="#"><h2>Project Owner</h2></a>
                    @if (auth()->user()->avatar == null)
                    <img src="{{ asset('../assets/img/noimage.png') }}"  class="w-80">
                @else
                <img  src="{{ asset('storage/assets/img/' . auth()->user()->avatar) }}" class="w-80">                    
                @endif                      
                
                <a href="#"><h4>{{ $project->client->name }}</h4></a>
                    <p>
                        {{ $project->client->email }}
                    </p>
                    <p>
                       +216 {{ $project->client->phone }}

                    </p>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>	
                    <div >
                            <a href="{{ route('index1', ['id' => $project->client->id]) }}" class="btn btn-primary btn-sm" style=" margin-left: 10px;">Chat</a>
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
            title: "Are you sure to Delete this projects",
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