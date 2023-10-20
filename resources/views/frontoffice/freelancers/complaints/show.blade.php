@extends('frontoffice.layouts.user_type.auth')

@section('content')

    <section class="banner-area relative" >	
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                        <h1 class="text-white">
                            Complaint Details :				
                        </h1>	
                        <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a>Complaint Details</a></p>
                </div>											
            </div>
        </div>
    </section>
    <section>
        <div style="margin-top: 100px;"></div>
    
          <div class="container" >
        <h1 class="mb-4">Complaint Details</h1>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Subject</th>
                <td>{{ $complaint->subject }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $complaint->description }}</td>
            </tr>
            <tr>
                <th>Submission Date</th>
                <td>{{ $complaint->submission_date }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $complaint->status }}</td>
            </tr>
            <tr>
                <th>Priority</th>
                <td>{{ $complaint->priority }}</td>
            </tr>
            </tbody>
        </table>

        <div class="text-center">
            @if ($complaint->status !== 'Treated')
                <a href="{{ route('frontoffice.freelancers.complaints.edit', $complaint->id) }}" class="btn btn-warning">Edit Complaint</a>
                <span style="margin: 10px;"></span> <!-- Add space between buttons -->
            @endif
            <a href="{{ route('frontoffice.freelancers.complaints.index') }}" class="btn btn-secondary">Return to Complaints</a>
            <span style="margin: 10px;"></span> <!-- Add space between buttons -->
            <a href="{{ route('frontoffice.freelancers.complaints.pdf', $complaint) }}" class="btn btn-primary">Export PDF</a>
        </div>
        <div style="margin-top: 100px;"></div>

    </div>
    
    </section>
@endsection


