@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Home 				
                </h1>	
                <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>Freelancer<a> </a></p>
            </div>											
        </div>
    </div>
</section>
{{-- <section class="submit-area section-gap">
    <div class="container">
        <div>
            <div class="">
                <div class="submit-left">
                    <h4>Submit For A New Project</h4>
                    <p>
                        Try To create your business project          
                    </p>
                    <a href="{{ url('/projects/create')}}" class="primary-btn header-btn">Submit Here</a>	
                </div>
            </div>
            {{-- <div class="col-lg-6 ">
                <div class="submit-right">
                    <h4>Submit a New Job Now!</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                    </p>
                    <a href="#" class="primary-btn header-btn">Post a Job</a>		
                </div>			
            </div> --}}

        </div>
    </div>	
</section> --}}

<section class="download-area section-gap" id="app">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 download-left">
                <img class="img-fluid" src="{{ asset('assets/frontoffice/img/d1.png') }}" alt="">
            </div>
            <div class="col-lg-6 download-right">
                <h1>Download the <br>
                Job Listing App Today!</h1>
                <p class="subs">
                    It won’t be a bigger problem to find one video game lover in your neighbor. Since the introduction of Virtual Game, it has been achieving great heights so far as its popularity and technological advancement are concerned.
                </p>
                <div class="d-flex flex-row">
                    <div class="buttons">
                        <i class="fa fa-apple" aria-hidden="true"></i>
                        <div class="desc">
                            <a href="#">
                                <p>
                                    <span>Available</span> <br>
                                    on App Store
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="buttons">
                        <i class="fa fa-android" aria-hidden="true"></i>
                        <div class="desc">
                            <a href="#">
                                <p>
                                    <span>Available</span> <br>
                                    on Play Store
                                </p>
                            </a>
                        </div>
                    </div>									
                </div>						
            </div>
        </div>
    </div>	
</section>



@endsection
