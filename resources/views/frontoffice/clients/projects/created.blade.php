@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        My Projects :
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> My Projects</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div class="container col-md-12">
        <div class="container">
            
            <div class="post-area section-gap">
                <div class="container">
                    <div class="row justify-content-center d-flex">
                        <div class="col-lg-8 post-list">
                            @if(session('success'))
                             <script>
                                 document.addEventListener('DOMContentLoaded', function () {
                                 swal({icon: 'success',title: 'Success',text: '{{ session('success') }}',
                                 showConfirmButton: false,timer: 3500});
                                });
                             </script>
                            @endif 
            
                            @foreach ($projects as $project)
                            <div class="single-post d-flex flex-row">
                                <div class="thumb">
                                    <img src="{{ asset('storage/assets/img/' . $project->image) }}" alt="" height="69" width="109">
                                    <ul class="tags">
                                        <li>
                                            <a href="#">{{ $project->category }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="details">
                                    <div class="title d-flex flex-row justify-content-between">
                                        <div class="titles">
                                            <h4> {{ $project->title }}</h4>
                                        </div>
                                    </div>
                                    <p>
                                        {{ $project->description }}
                                    </p>
                                    <h5>
                                        @if ($project->status == 'completed')
                                        <h4><span style="color: green">Completed</span></h4>
                                        @else
                                        <h4><span style="color: #FFF000;">Not Completed</span></h4>
                                        @endif
            
                                    </h5><p class="address"><span class="lnr lnr-map"></span> {{ $project->required_skills }}</p>
                                    <p class="address"><span class="lnr lnr-database"></span> {{ $project->cost }} $</p>
                                    <p class="address"><span class="lnr lnr-date"></span>Published on {{ $project->created_at->format('d F Y') }}</p>
                                    <button class="genric-btn success-border circle" style="display: inline;" type="button" onclick="window.location.href = '{{ route('projects.showC', ['id' => $project->id]) }}'">
                                        View <span class="lnr lnr-arrow-right"></span>
                                    </button>
                                    
                                    <button class="genric-btn warning-border circle" style="display: inline;" type="button" onclick="window.location.href = '{{ route('projects.edit1', ['id' => $project->id]) }}'">
                                        Modify
                                    </button>
                                    <form 
                                    action="{{ route('projects.destroy0', $project->id) }}"
                                    method="POST" onsubmit="confirmation(event)" style="display: inline;">
                                     @csrf
                                     @method('DELETE')
                                        <button class="genric-btn danger-border circle" type="submit">
                                         <span class="lnr lnr-arrow-right">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
            
                            @if ($projects->hasPages())
                            <div class="row">
                                @if ($projects->onFirstPage())
                                <a class="text-uppercase loadmore-btn mx-auto d-block">Previous</a>
                                @else
                                <a class="text-uppercase loadmore-btn mx-auto d-block" href="{{ $projects->previousPageUrl() }}">Previous</a>
                                @endif
            
                                @if ($projects->hasMorePages())
                                <a class="text-uppercase loadmore-btn mx-auto d-block" href="{{ $projects->nextPageUrl() }}">Next</a>
                                 @else
                                 <a class="text-uppercase loadmore-btn mx-auto d-block">Next</a>
                                 @endif
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4 sidebar">
                            <div class="single-slidebar">
                            <h4>Projects by Category</h4>
                            @if (auth()->user()->role == 1)
            
                            <ul class="cat-list">
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1') }}"><p>All Categories</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Administratif']) }}"><p>Administratif</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Application Mobile']) }}"><p>Application Mobile</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Autres']) }}"><p>Autres</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Commercial']) }}"><p>Commercial</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Comptabilité']) }}"><p>Comptabilité</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Développement spécifique']) }}"><p>Développement spécifique</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Formation Coaching']) }}"><p>Formation Coaching</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Gestion d’entreprise']) }}"><p>Gestion d’entreprise</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Graphisme et Design']) }}"><p>Graphisme et Design</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Logiciel']) }}"><p>Logiciel</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Logistique']) }}"><p>Logistique</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Musique et audio']) }}"><p>Musique et audio</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Rédaction web']) }}"><p>Rédaction web</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Site E-commerce']) }}"><p>Site E-commerce</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Traduction']) }}"><p>Traduction</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Vidéo et animation']) }}"><p>Vidéo et animation</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Web']) }}"><p>Web</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index1', ['category' => 'Webmarketing']) }}"><p>Webmarketing</p></a></li>
                            </ul>
                            @else 
                            <ul class="cat-list">
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index') }}"><p>All Categories</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Administratif']) }}"><p>Administratif</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Application Mobile']) }}"><p>Application Mobile</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Autres']) }}"><p>Autres</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Commercial']) }}"><p>Commercial</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Comptabilité']) }}"><p>Comptabilité</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Développement spécifique']) }}"><p>Développement spécifique</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Formation Coaching']) }}"><p>Formation Coaching</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Gestion d’entreprise']) }}"><p>Gestion d’entreprise</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Graphisme et Design']) }}"><p>Graphisme et Design</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Logiciel']) }}"><p>Logiciel</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Logistique']) }}"><p>Logistique</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Musique et audio']) }}"><p>Musique et audio</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Rédaction web']) }}"><p>Rédaction web</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Site E-commerce']) }}"><p>Site E-commerce</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Traduction']) }}"><p>Traduction</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Vidéo et animation']) }}"><p>Vidéo et animation</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Web']) }}"><p>Web</p></a></li>
                                <li><a class="justify-content-between d-flex" href="{{ route('projects.index', ['category' => 'Webmarketing']) }}"><p>Webmarketing</p></a></li>
                            </ul>
                            @endif
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
            title: "Are you sure to Delete this project",
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
