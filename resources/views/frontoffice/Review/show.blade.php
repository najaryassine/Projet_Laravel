@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area " id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-center">
            <div class="banner-content col-lg-12">
                <div class="card text-center" style ="margin-top: 200px;">
                
                    
                        <div class="row">
                            <div class="col-2">
                                <img src="https://i.imgur.com/xELPaag.jpg" width="70" class="rounded-circle mt-2">
                            </div>
                            
                            <div class="col-10">
                            <form method="POST" action="{{ route('reviews.update', ['id' => $review->id]) }}">
                            @method('PUT') 
                             @csrf
                            <div class="form-group">
                                                    <label for="rating">Rating:</label>
                                                    <input type="number" name="rating" value="{{ $review->rating }}" required>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="review">Review:</label>
                                                    <div class="comment-area">
                                        <textarea class="form-control" name="review"  rows="4" required>{{ $review->review }}</textarea>
                                    </div>
                                                </div>
                            
                                
                                    <div class="comment-btns mt-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="pull-left">
                                                <a href="http://localhost:8000/rate_review" class="btn btn-success btn-sm">Cancel</a>    
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
<br/>
@endsection
