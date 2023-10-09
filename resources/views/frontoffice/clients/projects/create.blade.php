@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Add Project :				
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Add Project</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div class="container col-md-6">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Add A Project</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Title') }}</label>
                                <div class="@error('project.title')border border-danger rounded-3 @enderror">
                                    <input class="form-control"  type="text" placeholder="Title" id="title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="description" class="form-control-label">{{ __('Description') }}</label>
                                <div class="@error('project.description')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="text" placeholder="Description" id="description" name="description" value="{{ old('description') }}" ></textarea>
                                    @error('description')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="image" class="form-control-label">{{ __('Image') }}</label>
                                <div class="@error('project.image')border border-danger rounded-3 @enderror">
                                    <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
                                        @error('image')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div> 
                    
                        <div>
                            <div class="form-group">
                                <label for="cost" class="form-control-label">{{ __('Cost') }}</label>
                                <div class="@error('project.cost')border border-danger rounded-3 @enderror">
                                <input class="form-control"  type="text" placeholder="Cost  ex : 500" id="cost" name="cost" value="{{ old('cost') }}" />
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div>
                            <div class="form-group">
                                <label for="required_skills" class="form-control-label">{{ __('Required Skills') }}</label>
                                <div class="@error('project.required_skills')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="text" id="required_skills" name="required_skills" value="{{ old('required_skills') }}" ></textarea>
                                    @error('required_skills')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="category" class="form-control-label">{{ __('Category') }}</label>
                                <div class="@error('project.category')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="category" name="category">
                                        <option value="Administratif">Administratif</option>
                                        <option value="Application Mobile">Application Mobile</option>
                                        <option value="Autres">Autres</option>
                                        <option value="Commercial">Commercial</option>
                                        <option value="Comptabilité">Comptabilité</option>
                                        <option value="Développement spécifique">Développement spécifique</option>
                                        <option value="Formation Coaching">Formation Coaching</option>
                                        <option value="Gestion d’entreprise">Gestion d’entreprise</option>
                                        <option value="Graphisme et Design">Graphisme et Design</option>
                                        <option value="Logiciel">Logiciel</option>
                                        <option value="Logistique">Logistique</option>
                                        <option value="Musique et audio">Musique et audio</option>
                                        <option value="Rédaction web">Rédaction web</option>
                                        <option value="Site E-commerce">Site E-commerce</option>
                                        <option value="Traduction">Traduction</option>
                                        <option value="Vidéo et animation">Vidéo et animation</option>
                                        <option value="Web">Web</option>
                                        <option value="Webmarketing">Webmarketing</option>
                                    </select>
                                    @error('category')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mt-20 text-white">Save</button>
                        </div>
                        <div class="mt-20 alert-msg" style="text-align: left;"></div>

                    </form>
                </div>
            </div>
        </div>	
</section>



@endsection
