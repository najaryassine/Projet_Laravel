@extends('frontoffice.layouts.user_type.auth')

@section('content')
<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Articles :
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Articles</a></p>
            </div>											
        </div>
    </div>
</section>

<section>
    <div class="container col-md-12"  >
        <div class="container">
            <h2>Articles</h2>
            <a class="btn btn-primary mb-2" href="{{ route('frontoffice.article.create') }}">Create Article</a>
    
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    
            <div class="row">
                @foreach ($articles as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $article->category }}</h6>
                                <p class="card-text">{{ $article->content }}</p>
                                <p>Likes: {{ $article->likes->count() }}</p>

                                <!-- Display comments if available -->
                                <h3>Comments</h3>
                                @if ($article->comments->isNotEmpty())
                                    @foreach ($article->comments as $comment)
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <p class="card-text">{{ $comment->body }}</p>
                                                
                                                <!-- Edit Comment Button -->
                                                <a href="{{ route('frontoffice.article.comments.edit', ['id' => $comment->id]) }}" class="btn btn-sm btn-primary">Edit Comment</a>
                                                
                                                <!-- Delete Comment Button -->
                                                <form class="d-inline" method="post" action="{{ route('frontoffice.article.comments.destroy', ['id' => $comment->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No comments available for this article.</p>
                                @endif
    
 <!-- Like/Unlike buttons -->
 @if (!$article->isLikedByUser(auth()->user()))

 <form method="POST" action="{{ route('articles.like', ['article' => $article]) }}">
     @csrf
     <button type="submit" style="background: none; border: none;"><i class="far fa-heart text-danger"></i></button>
 </form>
@else
 <form method="POST" action="{{ route('articles.unlike', ['article' => $article]) }}">
     @csrf
     @method('DELETE')
     <button type="submit" style="background: none; border: none;"><i class="fas fa-heart text-danger"></i></button>
 </form>
@endif
                                <h3>Add a Comment</h3>
                                <form method="post" action="{{ route('frontoffice.article.comments.store', ['id' => $article->id]) }}">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <div class="form-group">
                                        <label for="body">Comment</label>
                                        <textarea class="form-control" id="body" name="body" rows="4" ></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Comment</button>
                                </form>
    
                                <a href="{{ route('frontoffice.article.show', $article) }}" class="card-link">View Article</a>
                                <a href="{{ route('frontoffice.articles.edit', ['id' => $article->id]) }}">Edit Article</a>
                                <form method="POST" action="{{ route('frontoffice.article.delete', ['article' => $article]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Article</button>
                                </form>
    
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>	
<div class="mt-60 alert-msg" style="text-align: left;"></div>

</section>

@endsection





