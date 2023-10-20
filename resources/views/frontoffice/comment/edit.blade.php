@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Edit Comment :
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Edit Comment</a></p>
            </div>											
        </div>
    </div>
</section>

<section>
    <div class="container col-md-6"  style="padding-top: 150px;">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Edit Comment :</h1>
                </div>
            </div>
        </div>
        <div>
            <form method="POST" action="{{ route('frontoffice.comment.update', ['id' => $comment->id]) }}">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->
                <div class="form-group">
                    <label for="body">Comment</label>
                    <textarea class="form-control" id="body" name="body" rows="4">{{ $comment->body }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>	
<div class="mt-60 alert-msg" style="text-align: left;"></div>

</section>


@endsection

