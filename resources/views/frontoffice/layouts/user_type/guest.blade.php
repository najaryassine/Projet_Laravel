@extends('frontoffice.layouts.app')

@section('guest')
    {{-- @if(\Request::is('account')) 
        @include('frontoffice.layouts.navbars.guest.nav')
        @yield('content') 
    @else
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                </div>
            </div>
        </div>
        @include('frontoffice.layouts.footers.footer')
    @endif --}}

    @include('frontoffice.layouts.navbars.guest.nav')

    @yield('content')        

    @include('frontoffice.layouts.footers.footer')

@endsection