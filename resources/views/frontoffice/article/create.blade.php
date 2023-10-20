@extends('frontoffice.layouts.user_type.auth')

@section('content')
<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Create Article :
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Create Article</a></p>
            </div>											
        </div>
    </div>
</section>

<section>
    <div class="container col-md-6"  style="padding-top: 150px;">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Create Article :</h1>
                </div>
            </div>
        </div>
        <div>    
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <form method="POST" action="{{ route('frontoffice.article.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('category') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <textarea class="form-control" id="category" name="category" rows="5" required>{{ old('content') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>	
<div class="mt-60 alert-msg" style="text-align: left;"></div>

</section>


@endsection

