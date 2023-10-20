@extends('frontoffice.layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Task Details') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <p>Title: {{ $task->title }}</p>
            <p>Description: {{ $task->description }}</p>
            <p>Status: {{ $task->status }}</p>
            <p>Assigned to: {{ $task->user->name }}</p>
            
            <div>
                <a class="genric-btn primary-border circle" href="{{ route('tasks.edit', $task->id) }}">Modify</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="genric-btn danger-border circle" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
