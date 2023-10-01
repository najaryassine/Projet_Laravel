@extends('frontoffice.layouts.user_type.auth')

@section('content')
    <section class="article-list section-gap" id="articles">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2>Articles</h2>
                        <p>Discover our latest articles.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($articles as $article)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-article">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ Str::limit($article->content, 150) }}</p>
                            <a href="{{ route('articles.show', ['article' => $article->id]) }}" class="read-more">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
