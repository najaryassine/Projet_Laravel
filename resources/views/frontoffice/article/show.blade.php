@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->content }}</p>
        <a class="btn btn-secondary" href="{{ route('frontoffice.article.index') }}">Back to Articles</a>
    </div>
@endsection
