@extends('layouts.user_type.auth')

@section('content')

<div>

        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Add User :') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="create" method="POST" role="form text-left" enctype="multipart/form-data">
                        @csrf
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
                                        <input class="form-control"  type="text" placeholder="Name" id="user-name" name="name" value="{{ old('name') }}">
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
                                        <input class="form-control" type="date"  name="date_of_birth" value="{{ old('date_of_birth') }}">
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
                                        <input class="form-control" type="email" placeholder="Email" id="user-email" name="email" value="{{ old('email') }}">
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
                                        <input class="form-control" type="tel" placeholder="Phone Number" id="user-phone" name="phone" value="{{ old('phone') }}">
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
                                                <input type="file" class="form-control-file" id="avatar" name="avatar" value="{{ old('avatar') }}">
                                                    @error('avatar')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="user-password" class="form-control-label">{{ __('Password') }}</label>
                                            <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                                <input class="form-control" type="password" placeholder="Password" id="user-password" name="password" value="{{ old('password') }}">
                                                @error('password')
                                                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
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
</div>


@push('scripts')
<script>
    setTimeout(function() {
        document.getElementById('error-alert').style.display = 'none';
    }, 2000);

    setTimeout(function() {
        document.getElementById('success-alert').style.display = 'none';
    }, 2000);
</script>
@endpush

@endsection