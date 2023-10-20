@extends('frontoffice.layouts.user_type.auth')

@section('content')

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Edit Task :				
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Edit Task</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div class="container col-md-6">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Edit Task</h1>
                </div>
            </div>
        </div>
            <div class="container-fluid py-4">
                <h1>Edit Task</h1>
        
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- or @method('PATCH') depending on your configuration --}}
                    
                    <div class="form-group">
                        <label for="title">Task Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                    </div>
        
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
                    </div>
        
                       
        
                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}">
                    </div>
        
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
</section>



@endsection

