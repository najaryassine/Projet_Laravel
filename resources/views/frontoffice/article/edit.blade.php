@extends('frontoffice.layouts.user_type.auth')


@section('content')
    <div class="container">
        <h2>Edit Article</h2>
        <form method="POST" action="{{ route('article.update', ['id' => $article->id]) }}">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $article->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
