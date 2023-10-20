@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Add Comment') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('comments.store') }}" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert" id="error-alert">
                            <!-- Error handling code here -->
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                            <!-- Success message handling code here -->
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="comment-body" class="form-control-label">{{ __('Body') }}</label>
                        <div class="@error('body') border border-danger rounded-3 @enderror">
                            <textarea class="form-control" rows="5" placeholder="Body" id="comment-body" name="body">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
    <label for="article-title" class="form-control-label">{{ __('Choose Article by Title') }}</label>
    <div class="@error('article_id') border border-danger rounded-3 @enderror">
        <select class="form-select" id="article-title" name="article_id">
            @foreach($articles as $article)
                <option value="{{ $article->id }}">{{ $article->title }}</option>
            @endforeach
        </select>
        @error('article_id')
            <p class="text-danger text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>


                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ __('Save Comment') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
