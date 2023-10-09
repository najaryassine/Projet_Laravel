<header id="header" id="home">
  <div class="container">
    <div class="row align-items-center justify-content-between d-flex">
      <div id="logo">
        <a href="index.html"><img src="{{ asset('assets/frontoffice/img/pnglogo.png') }}" width="250" height="50"  /></a>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="index.html">Home</a></li>
          <li><a href="{{ url('/aboutus')}}">About Us</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li><a class="ticker-btn" href="{{ auth()->user() ? url('static-sign-up') : url('/account/register') }}">Signup</a></li>
          <li><a class="ticker-btn" href="{{ auth()->user() ? url('static-sign-in') : url('/account/login') }}">Login</a></li>				          				          
        </ul>
      </nav><!-- #nav-menu-container -->		    		
    </div>
  </div>
</header><!-- #header -->