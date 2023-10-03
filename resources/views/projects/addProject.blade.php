@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Add Project :') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="add" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @if(session('success'))
                        <!-- Success Alert -->
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="form-control-label">{{ __('Title') }}</label>
                                <div class="@error('title')border border-danger rounded-3 @enderror">
                                    <input class="form-control"  type="text" placeholder="Title" id="title" name="title" value="{{ old('title') }}">
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
                                    <textarea class="form-control"  placeholder="Description" id="description" name="description">{{ old('description') }}</textarea>
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
                                    <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
                                    @error('image')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_id" class="form-control-label">{{ __('Client') }}</label>
                                <div class="@error('client_id')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="client_id" name="client_id">
                                        <option value="">Select Client</option>
                                        @foreach($users as $user)
                                            @if($user->role == 1)
                                                <option value="{{$user->id}}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('client_id')
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
                                    <input class="form-control" type="number" placeholder="Cost" id="cost" name="cost" value="{{ old('cost') }}">
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label for="required_skills" class="form-control-label">{{ __('Required Skills') }}</label>
                        <div class="@error('project.required_skills')border border-danger rounded-3 @enderror">
                        <textarea class="form-control"  type="text" id="required_skills" name="required_skills" value="{{ old('required_skills') }}" ></textarea>
                            @error('required_skills')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
                </div>
@endsection                    