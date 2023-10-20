@extends('frontoffice.layouts.user_type.auth')

@section('content')
    <div style="margin-top: 200px;"></div>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Portfolios</h1>
        <div style="margin-top: 70px;"></div>
        @if ($portfolios->isEmpty())
            <div class="alert alert-info">
                No Portfolio Found.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col" class="text-nowrap">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($portfolios as $portfolio)
                    <tr>
                        <td>
                            @if ($portfolio->titre)
                                {{ $portfolio->titre }}
                            @else
                                Titre non défini
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <a href="{{ route('frontoffice.freelancers.portfolios.show', $portfolio->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <div style="margin-top: 100px;"></div>
        <div class="text-center">
            <a href="{{ route('frontoffice.freelancers.portfolios.create') }}" class="btn btn-success">Add a portfolio</a>
        </div>
    </div>
@endsection
