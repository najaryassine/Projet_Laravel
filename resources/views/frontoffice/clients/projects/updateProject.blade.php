@extends('frontoffice.layouts.user_type.auth')

@section('content')




<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Update Projects :
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Update Project</a></p>
            </div>											
        </div>
    </div>
</section>

<section>
    <div class="container col-md-6"  style="padding-top: 150px;">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Update Your Project :</h1>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body pt-4 p-3 d-flex justify-content-center">
            <form action="{{ route('projects.update1', ['id' => $project->id]) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-control-label">{{ __('Title') }}</label>
                            <div class="@error('title')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Title" id="title" name="title" value="{{ $project->title }}">
                                @error('title')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description" class="form-control-label">{{ __('Description') }}</label>
                            <div class="@error('description')border border-danger rounded-3 @enderror">
                                <textarea class="form-control" placeholder="Description" id="description" name="description">{{ $project->description }}</textarea>
                                @error('description')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" class="form-control-label">{{ __('Image') }}</label>
                            <div class="@error('image')border border-danger rounded-3 @enderror">
                                <input type="file" class="form-control-file" id="image" name="image">
                                @error('image')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost" class="form-control-label">{{ __('Cost') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="number" placeholder="Cost" id="cost" name="cost" value="{{$project->cost}}">
                                @error('cost')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-control-label">{{ __('Category') }}</label>
                        <div class="@error('project.category')border border-danger rounded-3 @enderror">
                            <select class="form-control" id="category" name="category" disabled>
                                <option value="Administratif" {{ $project->category === 'Administratif' ? 'selected' : '' }}>Administratif</option>
                                <option value="Application Mobile" {{ $project->category === 'Application Mobile' ? 'selected' : '' }}>Application Mobile</option>
                                <option value="Autres" {{ $project->category === 'Autres' ? 'selected' : '' }}>Autres</option>
                                <option value="Commercial" {{ $project->category === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="Comptabilité" {{ $project->category === 'Comptabilité' ? 'selected' : '' }}>Comptabilité</option>
                                <option value="Développement spécifique" {{ $project->category === 'Développement spécifique' ? 'selected' : '' }}>Développement spécifique</option>
                                <option value="Formation Coaching" {{ $project->category === 'Formation Coaching' ? 'selected' : '' }}>Formation Coaching</option>
                                <option value="Gestion d’entreprise" {{ $project->category === 'Gestion d’entreprise' ? 'selected' : '' }}>Gestion d’entreprise</option>
                                <option value="Graphisme et Design" {{ $project->category === 'Graphisme et Design' ? 'selected' : '' }}>Graphisme et Design</option>
                                <option value="Logiciel" {{ $project->category === 'Logiciel' ? 'selected' : '' }}>Logiciel</option>
                                <option value="Logistique" {{ $project->category === 'Logistique' ? 'selected' : '' }}>Logistique</option>
                                <option value="Musique et audio" {{ $project->category === 'Musique et audio' ? 'selected' : '' }}>Musique et audio</option>
                                <option value="Rédaction web" {{ $project->category === 'Rédaction web' ? 'selected' : '' }}>Rédaction web</option>
                                <option value="Site E-commerce" {{ $project->category === 'Site E-commerce' ? 'selected' : '' }}>Site E-commerce</option>
                                <option value="Traduction" {{ $project->category === 'Traduction' ? 'selected' : '' }}>Traduction</option>
                                <option value="Vidéo et animation" {{ $project->category === 'Vidéo et animation' ? 'selected' : '' }}>Vidéo et animation</option>
                                <option value="Web" {{ $project->category === 'Web' ? 'selected' : '' }}>Web</option>
                                <option value="Webmarketing" {{ $project->category === 'Webmarketing' ? 'selected' : '' }}>Webmarketing</option>
                            </select>
                            @error('category')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary bg-gradient-primary btn-md mt-4 mb-4">{{ __('Save Changes') }}</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>	
<div class="mt-60 alert-msg" style="text-align: left;"></div>

</section>


@endsection
