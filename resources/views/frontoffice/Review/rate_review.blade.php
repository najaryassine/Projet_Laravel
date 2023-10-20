@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area" id="home">
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
                                <img src="https://i.imgur.com/xELPaag.jpg" width="70" class="rounded-circle mt-2">
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
                                                    <a href="projects/list" class="btn btn-success btn-sm">Cancel</a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-success send btn-sm">Send <i class="fa fa-long-arrow-right ml-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <ol>
                                        @foreach($reviews as $index => $review)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <img src="{{ $review->user->image_url }}" alt="{{ $review->user->name }}" class="user-image">
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
                                                        <a href="{{ route('reviews.destroy', ['id' => $review->id]) }}" class="btn text-color:red ">Delete</a>
                                                            <a href="{{ route('reviews.show', ['id' => $review->id]) }}" class="btn ">Update</a>
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
</section>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

@endsection
