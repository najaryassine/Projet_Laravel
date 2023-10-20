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
                    <div class="bottom-meta">
                        <div class="user-details row align-items-center">
                            <div class="comment-wrap col-lg-6 col-sm-6">
                                <ul>
                                @if (auth()->user()->role == 1)
                                    @if (auth()->user()->id == $project->client_id)
                                    <a class="genric-btn primary-border circle "  href="{{ route('projects.edit1', [ 'id' => $project->id])}}">Modify</a>
                                    <a class="genric-btn primary-border circle" href="{{ route('tasks.create', ['projectId' => $project->id]) }}">Add Task</a>
                                    <a class="genric-btn primary-border circle "  href="{{ route('frontoffice.tasks.index', [ 'id' => $project->id])}}">all tasks</a>

                                                      @endif

    
                                @elseif (auth()->user()->role == 2)

                                @if (auth()->check() && auth()->user()->role === 2 && auth()->user()->assignedTasks->isNotEmpty())
    <a href="{{ route('tasks.assignedToYou') }}" class="genric-btn primary-border circle">Tasks Assigned to You</a>
@else
    @if (in_array($project->id, $appliedContracts->pluck('project_id')->toArray()))
        <a class="genric-btn primary-border circle disable" disabled>Already Applied</a>
    @else
        <a href="{{ route('apply.contract', ['userId' => Auth::user()->id, 'projectId' => $project->id, 'cost' => intval($project->cost), 'clientId' => $project->client_id]) }}" class="genric-btn primary-border circle">Apply Contract
            <span class="lnr lnr-arrow-right"></span>
        </a>
    @endif
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
                </div>
        </div>

    </div>    
</section>

@endsection