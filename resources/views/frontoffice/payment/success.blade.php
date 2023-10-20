@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success">
                {{ $message }}
            </div>
            <a href="{{ url('/contracts-management') }}" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
</div>
@endsection
