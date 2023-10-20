@extends('frontoffice.layouts.user_type.auth')

@extends('layouts.app')

@section('content')
    <div style="margin-top: 200px;"></div>
    <style>

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }



        .center-buttons button {
            margin: 5px;
        }
    </style>

    <div class="center-content">
        <h1 style="color: #3498db;">Portfolio Details</h1>

        <table>
            <tr>
                <td style="color: #333;">Title :</td>
                <td>{{ $portfolio->titre }}</td>
            </tr>
            <tr>
                <td style="color: #333;">Description :</td>
                <td>{{ $portfolio->description }}</td>
            </tr>
            <tr>
                <td style="color: #333;">Date :</td>
                <td>{{ $portfolio->date }}</td>
            </tr>
            <tr>
                <td style="color: #333;">Technologies :</td>
                <td>{{ $portfolio->technologies }}</td>
            </tr>
            <tr>
                <td style="color: #333;">Client :</td>
                <td>{{ $portfolio->client }}</td>
            </tr>
            <tr>
                <td style="color: #333;">Status :</td>
                <td>{{ $portfolio->statut }}</td>
            </tr>
        </table>

        <div style="margin-top: 20px;"></div>

        <div class="form-group text-center">

            <a href="{{ route('frontoffice.freelancers.portfolios.edit', $portfolio->id) }}" class="btn btn-primary">Modify</a>

            <form action="{{ route('frontoffice.freelancers.portfolios.destroy', $portfolio->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </div>
        </div>


        <a href="{{ route('frontoffice.freelancers.portfolios.index') }}" class="btn btn-secondary mt-3">Return</a>
    </div>
@endsection
