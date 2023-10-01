@extends('frontoffice.layouts.app')

@section('auth')
        @if(auth()->user()->role == 1)
        <main >
            @include('frontoffice.layouts.navbars.auth.nav1')
            <div class="container-fluid py-4">
                @yield('content')
                @include('frontoffice.layouts.footers.footer')
            </div>
        </main>
        @elseif (auth()->user()->role == 2)
        <main >
            @include('frontoffice.layouts.navbars.auth.nav2')
            <div class="container-fluid py-4">
                @yield('content')
                @include('frontoffice.layouts.footers.footer')
            </div>
        </main>
        @endif

@endsection