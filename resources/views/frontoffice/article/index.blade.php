@extends('frontoffice.layouts.user_type.auth')

@section('content')
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

                            <!-- Display comments if available -->
                            <h3>Comments</h3>
                            @if ($article->comments->isNotEmpty())
                                @foreach ($article->comments as $comment)
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p class="card-text">{{ $comment->body }}</p>
                                            
                                            <!-- Edit Comment Button -->
                                            <a href="{{ route('frontoffice.article.comments.edit', ['article' => $article, 'comment' => $comment]) }}" class="btn btn-sm btn-primary">Edit Comment</a>
                                            
                                            <!-- Delete Comment Button -->
                                            <form class="d-inline" method="post" action="{{ route('frontoffice.article.comments.destroy', ['article' => $article, 'comment' => $comment]) }}">
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

                            <!-- Comment form for each article -->
                            <h3>Add a Comment</h3>
                            <form method="post" action="{{ route('frontoffice.article.comments.store', ['article' => $article]) }}">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <div class="form-group">
                                    <label for="body">Comment</label>
                                    <textarea class="form-control" id="body" name="body" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>

                            <a href="{{ route('frontoffice.article.show', $article) }}" class="card-link">View Article</a>
                            <a href="{{ route('articles.edit', ['id' => $article->id]) }}">Edit Article</a>
                            <form method="POST" action="{{ route('frontoffice.article.delete', $article) }}">
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
@endsection
