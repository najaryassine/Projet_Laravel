@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Add Task :				
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Add Task</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div class="container col-md-6">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Add A Task</h1>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Add Task :') }}</h6> <!-- Vous pouvez changer le titre ici -->
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="create" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="project_id" value="{{ $projectId }}">
        
                        @if(session('success'))
                            <!-- Success Alert -->
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-control-label">{{ __('Task Title') }}:</label>
                                    <div class="@error('title')border border-danger rounded-3 @enderror">
                                        <input class="form-control"  type="text" placeholder="{{ __('Task Title') }}" id="title" name="title" value="{{ old('title') }}">
                                        @error('title')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">{{ __('Description') }}:</label>
                                    <div class="@error('description')border border-danger rounded-3 @enderror">
                                        <textarea class="form-control"  placeholder="{{ __('Description') }}" id="description" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="assigned_to" class="form-control-label">{{ __('Assigned to') }}:</label>
                            <div class="@error('assigned_to')border border-danger rounded-3 @enderror">
                                <select name="assigned_to" id="assigned_to" class="form-control">
                                    <option value="">{{ __('Select a freelancer') }}</option>
                                    @foreach ($freelancers as $freelancer)
                                        <option value="{{ $freelancer->id }}">{{ $freelancer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="due_date" class="form-control-label">{{ __('Due Date') }}:</label>
                            <div class="@error('due_date')border border-danger rounded-3 @enderror">
                                <input type="date" name="due_date" id="due_date" class="form-control">
                                @error('due_date')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
        
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-md mt-4 mb-4">{{ __('Create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>



@endsection

