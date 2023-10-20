@extends('frontoffice.layouts.user_type.auth')

@section('content')
    <div class="container">
        <h2>Comments for "{{ $article->title }}"</h2>

        <div class="row">
            @foreach ($article->comments as $comment)
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }}</h6>
                            <p class="card-text">{{ $comment->body }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
