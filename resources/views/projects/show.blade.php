@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Project Details:') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    @if ($project->image == null)
                    <img src="{{ asset('storage/assets/img/noimage.png') }}" class="avatar avatar-sm me-3" height="300" width="300">
                    @else
                    <img src="{{ asset('storage/assets/img/' . $project->image) }}"  height="250" width="250">
                    @endif
                    <h5>Title: {{ $project->title }}</h5>
                    <p>Description: {{ $project->description }}</p>
                    <p>Client Name: {{ $project->client->name }}</p>
                    <p>Cost: {{ $project->cost }}</p>
                    <p>Category: {{ $project->category }}</p>
                    <p>Status :
                        @if ($project->status == 'not_completed')
                            <span class="text-primary">Not Completed</span>
                        @else
                            <span class="text-success">Completed</span>
                        @endif
                    </p>

                </div>
            </div>
                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4 mb-4">{{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection