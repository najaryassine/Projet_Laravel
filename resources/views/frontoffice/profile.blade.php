@extends('frontoffice.layouts.user_type.auth')

@section('content')
<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Profile Information:				
                </h1>	
                <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Profile</a></p>
            </div>											
        </div>
    </div>
</section>
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
    swal({ icon: 'error',
            title: 'Error',
            text: '{{$errors->first()}}',
            timer: 3500,
            showConfirmButton: false});
   });
</script>
@endif

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
    swal({icon: 'success',title: 'Success',text: '{{ session('success') }}',
    showConfirmButton: false,timer: 3500});
   });
</script>
@endif
<section class="contact-page-area section-gap ">
    <div class="container">
            <div class="col-lg-12">
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
                </div>
  
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name }}                        
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            @if(auth()->user()->role == 1)
                            Client
                            @else
                            Freelancer
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-body pt-4">
                        @if (auth()->user()->role == 1)
                        <form action="/profile" method="POST" role="form text-left" enctype="multipart/form-data">    
                        @else
                        <form action="/profile2" method="POST" role="form text-left" enctype="multipart/form-data">    
                        @endif
                            @csrf        
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
                                    <div class="form-group" >
                                        <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                        <div class="@error('user.email')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="email" placeholder="Email" id="user-email" name="email" value="{{ auth()->user()->email }}" >
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
                                                <input type="file" class="form-control-file" id="avatar" name="avatar" >
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
                                        <button type="submit" class="btn ticker-btn  mt-4 mb-4">{{ __('Save Changes') }}</button>
                                        
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div> 
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-body pt-4">
                        @if (auth()->user()->role == 1)
                        <form action="/profile2/password" method="POST">
                            @else
                            <form action="/profile2/password" method="POST">
                            @endif
                            @csrf
                            <h3>Change Your Password </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="old_password">Old Password:</label>
                                        <input class="form-control-file" type="password" id="old_password" name="old_password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="new_password">New Password:</label>
                                        <input class="form-control-file" type="password" id="new_password" name="new_password">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input class="form-control-file" type="password" id="new_password_confirmation" name="new_password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                      
                            <div>
                                <button type="submit" class="btn ticker-btn  mt-4 mb-4">{{ __('Save Changes') }}</button>
                                
                            </div>
                        </div>


                        </div>

                        </form>

                    </div>
                </div>
            </div>        
        </div>
    </div>
   

            </div>
        </div>
    </div>	
</section>

@endsection