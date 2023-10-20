@extends('frontoffice.layouts.user_type.auth')


@section('content')
 

<section class="banner-area relative" >	
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Portfolio Details :				
                    </h1>	
                    <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Portfolio Details</a></p>
            </div>											
        </div>
    </div>
</section>
<section>
    <div style="margin-top: 100px;"></div>

    <div class="container col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 style="mb-10;color: #3498db;">Portfolio Details</h1>

                </div>
            </div>
        </div>

        <div class="container">

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
                    <a href="{{ route('frontoffice.freelancers.portfolios.index') }}" class="btn btn-secondary mt-3">Return</a>

                </div>
        
        

        </div>
    </div>


</section>


<script>
    function confirmation(ev) {
        ev.preventDefault();
        var form = ev.currentTarget;
        var urlToSubmit = form.getAttribute('action');

        swal({
            title: "Are you sure to Cancel this Contract",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    }
</script>
@endsection
