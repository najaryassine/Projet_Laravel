@extends('layouts.user_type.auth')

@section('content')

<div>
    <form action="/user-profile" method="POST" role="form text-left" enctype="multipart/form-data">                    @csrf

    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="avatar avatar-xl position-relative"> 
                    @if (auth()->user()->avatar == null)
                        <img id="avatar-preview" src="{{ asset('../assets/img/noimage.png') }}" alt="Default Avatar" class="w-100 border-radius-lg shadow-sm">
                    @else
                    <img id="avatar-preview" src="{{ asset('storage/assets/img/' . auth()->user()->avatar) }}" alt="User Avatar" class="w-100 border-radius-lg shadow-sm">                    
                    @endif     
                    <label for="user-avatar" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                        <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                    </label>
                    <input class="form-control visually-hidden" type="file">                    </div>
  
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name }}                        
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            @if(auth()->user()->role == 0)
                            Admin
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" role="form text-left" enctype="multipart/form-data">                    @csrf

                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert" id="error-alert">
                            <span class="alert-text text-white">
                                {{$errors->first()}}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('error-alert').style.display = 'none';
                            }, 2000);
                        </script>
                    @endif

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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.date_of_birth" class="form-control-label">Date of Birth</label>
                                <div class="@error('user.date_of_birth')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="date"  name="date_of_birth" value="{{ auth()->user()->date_of_birth }}">
                                    @error('date_of_birth')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('user.email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="email" placeholder="Email" id="user-email" name="email" value="{{ auth()->user()->email }}">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-phone" class="form-control-label">{{ __('Phone Number') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="Phone Number" id="user-phone" name="phone" value="{{ auth()->user()->phone }}">
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-avatar" class="form-control-label">{{ __('Avatar') }}</label>
                                    <div class="@error('user.avatar')border border-danger rounded-3 @enderror">
                                        {{-- <input class="form-control" type="file" id="avatar" name="avatar" value="{{ auth()->user()->avatar }}"> --}}
                                        <input type="file" class="form-control-file" id="avatar" name="avatar">
                                            @error('avatar')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about">{{ 'About Me' }}</label>
                            <div class="@error('user.about')border border-danger rounded-3 @enderror">
                                <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about">{{ auth()->user()->about }}</textarea>
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
        </div>
    </div>    
    </form>

    </div>
@endsection