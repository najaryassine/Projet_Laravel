@extends('frontoffice.layouts.user_type.auth')

@extends('layouts.app')

@section('content')
    <div style="margin-top: 200px;"></div>
    <h1 class="text-center">Create a portfolio</h1>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <form action="{{ route('frontoffice.freelancers.portfolios.store') }}" method="POST" class="col-md-6">
            @csrf

            <div class="form-group">

                <input type="hidden" name="freelancer_id" value="{{ $freelancerId }}">
            </div>

            <div class="form-group">
                <label for="titre">Title :</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="technologies">Technologies :</label>
                <input type="text" name="technologies" id="technologies" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="client">Client :</label>
                <input type="text" name="client" id="client" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="statut">Status :</label>
                <select name="statut" id="statut" class="form-control" required>
                    <option value="Completed">Completed</option>
                    <option value="In progress">In progress</option>
                    <option value="Archived">Archived</option>
                </select>
            </div>

            <div class="form-group text-center">
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Create Portfolio</button>
                    <a href="{{ route('frontoffice.freelancers.portfolios.index') }}" class="btn btn-secondary mt-0">Return</a>
                </div>
            </div>

        </form>
    </div>

@endsection
