@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Update Contract :') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('contracts.update1', ['id' => $contract->id]) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_id" class="form-control-label">{{ __('Project title') }}</label>
                                <div class="@error('project_id')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="project_id" name="project_id">
                                        @foreach($projects as $project)
                                                <option value="{{$project->id}}"  {{ $contract->project_id === $project->id ? 'selected' : '' }}>{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="freelancer_id" class="form-control-label">{{ __('Client Name') }}</label>
                                <div class="@error('freelancer_id')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="freelancer_id" name="freelancer_id">
                                        @foreach($users as $user)
                                                <option value="{{$user->id}}"  {{ $user->id === $contract->freelancer_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('freelancer_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_id" class="form-control-label">{{ __('Client Name') }}</label>
                                <div class="@error('client_id')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="client_id" name="client_id">
                                        @foreach($users as $user)
                                                <option value="{{$user->id}}" {{ $user->id === $contract->client_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_cost" class="form-control-label">{{ __('Project cost') }}</label>
                                <div class="@error('project_cost')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="number"  id="project_cost" name="project_cost" value="{{ intval(old('project_cost')) }}">
                                    @error('project_cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-control-label">{{ __('Status') }}</label>
                        <div class="@error('contract.status')border border-danger rounded-3 @enderror">
                            <select class="form-control" id="status" name="status">
                                <option value="pending" {{ $contract->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $contract->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $contract->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
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
@endsection                    