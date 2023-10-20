@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                         Tasks List :				
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Tasks List</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div class="container col-md-6">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Task List</h1>
                </div>
            </div>
        </div>
       
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
</section>



@endsection

