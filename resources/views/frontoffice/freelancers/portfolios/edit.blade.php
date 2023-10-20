@extends('frontoffice.layouts.user_type.auth')

@section('content')


    <section class="banner-area relative" >	
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                        <h1 class="text-white">
                            Modify Portfolio :
                        </h1>	
                        <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a>  Modify Portfolio</a></p>
                </div>											
            </div>
        </div>
    </section>
    
    <section>
        <div style="margin-top: 50px;"></div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4">Modify Portfolio</h1>

                    <div class="card">
                        <div class="card-body">
                            <!-- Add a form element for updating the portfolio -->
                            <form method="POST" action="{{ route('frontoffice.freelancers.portfolios.update', ['portfolio' => $portfolio]) }}">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updates -->
                                <table class="table table-bordered text-center">
                                    {{-- <thead class="btn-primary text-white">
                                    <tr>
                                        <th colspan="2">Modify a portfolio</th>
                                    </tr>
                                    </thead> --}}
                                    <tbody>
                                    <tr>
                                        <td>Title:</td>
                                        <td><input type="text" name="titre" class="form-control" value="{{ $portfolio->titre }}" required></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td><textarea name="description" class="form-control" required>{{ $portfolio->description }}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Date:</td>
                                        <td><input type="date" name="date" class="form-control" value="{{ $portfolio->date }}" required></td>
                                    </tr>
                                    <tr>
                                        <td>Technologies:</td>
                                        <td><input type="text" name="technologies" class="form-control" value="{{ $portfolio->technologies }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Client:</td>
                                        <td><input type="text" name="client" class="form-control" value="{{ $portfolio->client }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td>
                                            <select name="statut" class="form-control" required>
                                                <option value="Completed" {{ $portfolio->statut == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="In progress" {{ $portfolio->statut == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                <option value="Archived" {{ $portfolio->statut == 'Archived' ? 'selected' : '' }}>Archived</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <!-- Include other fields here as needed -->
                                    </tbody>
                                </table>
    
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Update Portfolio</button>
                                    </div>
                                    <div>
                                        <a href="{{ route('frontoffice.freelancers.portfolios.index') }}" class="btn btn-secondary mt-3">Return</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>	
    <div class="mt-60 alert-msg" style="text-align: left;"></div>
    
    </section>
@endsection
