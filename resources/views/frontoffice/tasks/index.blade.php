@extends('frontoffice.layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Liste des tâches') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            @if(session('success'))
                <!-- Add your success message alert here -->
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <ul>
                @foreach($tasks as $task)
                    <li>
                        <h4>{{ $task->title }}</h4>
                        <p>Status: {{ $task->status }}</p>
                        <a class="genric-btn primary-border circle" href="{{ route('tasks.show', ['id' => $task->id]) }}">View</a>
                    </li>
                @endforeach
            </ul>

            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
