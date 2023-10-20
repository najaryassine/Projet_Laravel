@extends('frontoffice.layouts.user_type.auth')

@section('content')
<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Rate Review :				
                </h1>	
                <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Rate Review </a></p>
            </div>											
        </div>
    </div>
</section>

<section>
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-center">
            <div class="banner-content col-lg-12">
                <div class="card text-center" style="margin-top: 200px;">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        <div class="row">
                        @if(session('success'))
                 <script>
                     document.addEventListener('DOMContentLoaded', function () {
                     swal({icon: 'success',title: 'Success',text: '{{ session('success') }}',
                     showConfirmButton: false,timer: 3500});
                    });
                 </script>
                @endif 
                            <div class="col-2">
                                @if (auth()->user()->avatar == null)
                                <img src="{{ asset('../assets/img/noimage.png') }}"   width="70" class="rounded-circle mt-2">
                            @else
                                <img  src="{{ asset('storage/assets/img/' . auth()->user()->avatar) }}"  width="70" class="rounded-circle mt-2" >                    
                            @endif   
                            </div>
                            <div class="col-10">
                                <div class="comment-box ml-2">
                                    <h4>Add a review</h4>
                                    <div>
                                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                        <input type="radio" name ="rating" value="4" id="4"><label for="4">☆</label>
                                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                    </div>
                                    <div class="comment-area">
                                        <textarea class="form-control" name="review" placeholder="What is your view?" rows="4" required></textarea>
                                    </div>
                                    <div class="comment-btns mt-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="pull-left">
                                                    <button href="projects/list" class="genric-btn danger-border circle"  type="button">Cancel</button>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="pull-right">
                                                    <button type="submit" class="genric-btn primary-border circle"  type="button">Send <i class="fa fa-long-arrow-right ml-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <ol>
                                        @foreach($reviews as $index => $review)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="row">
                                                        @if (auth()->user()->avatar == null)
                                                            <img src="{{ asset('../assets/img/noimage.png') }}" height="35" width="40">
                                                        @else
                                                            <img  src="{{ asset('storage/assets/img/' . auth()->user()->avatar) }}" height="55" width="60"  >                    
                                                        @endif    
                                                        <p>{{auth()->user()->name}}</p> 
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="rating" style="position: absolute; left: 25px;">
                                                            @for ($i = 1; $i <= $review->rating; $i++)
                                                                <span class="star{{ $i <= $review->rating ? ' active' : '' }}">☆</span>
                                                            @endfor
                                                        </div>
                                                        <div class="comment-area" style="position: absolute; left: 25px; margin-top: 17px;">
                                                            {{ $review->review }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12" style="left: 700px; margin-top : 20px">
                                                        
                                                    <div class="comment-area" style="position: absolute; left: 25px; margin-top: 17px;">
                                                        <div class="comment-area" style=" left: 25px; margin-top: -50px;">
                                                            {{ $review->created_at }}
                                                        </div>
                                                            
                                                        </div>
                                                    <div class="d-flex">
                                                        @if(Auth::user()->id === $review->user_id)
                                                        <button href="{{ route('reviews.destroy', ['id' => $review->id]) }}"  class="genric-btn danger-border circle"  type="button">Delete</button>
                                                        <button href="{{ route('reviews.show', ['id' => $review->id]) }}"  class="genric-btn warning-border circle"  type="button">Update</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 50px;"></div>

</section>


@endsection
