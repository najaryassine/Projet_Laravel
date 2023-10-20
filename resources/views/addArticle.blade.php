@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Add Article :') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('articles.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert" id="error-alert">
                            <span class="alert-text text-white">
                                {{ $errors->first() }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('error-alert').style.display = 'none';
                            }, 2000);
                        </script>
                    @endif

                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                            <span class="alert-text text-white">
                                {{ session('success') }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('success-alert').style.display = 'none';
                            }, 2000);
                        </script>
                    @endif

                    <div class="form-group">
                        <label for="article-title" class="form-control-label">{{ __('Title') }}</label>
                        <div class="@error('title') border border-danger rounded-3 @enderror">
                            <input class="form-control" type="text" placeholder="Title" id="article-title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="article-content" class="form-control-label">{{ __('Content') }}</label>
                        <div class="@error('content') border border-danger rounded-3 @enderror">
                            <textarea class="form-control" rows="5" placeholder="Content" id="article-content" name="content">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="article-category" class="form-control-label">{{ __('Category') }}</label>
                        <div class="@error('category') border border-danger rounded-3 @enderror">
                            <input class="form-control" type="text" placeholder="Category" id="article-category" name="category" value="{{ old('category') }}">
                            @error('category')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    setTimeout(function() {
        document.getElementById('error-alert').style.display = 'none';
    }, 2000);

    setTimeout(function() {
        document.getElementById('success-alert').style.display = 'none';
    }, 2000);
</script>
@endpush

@endsection
