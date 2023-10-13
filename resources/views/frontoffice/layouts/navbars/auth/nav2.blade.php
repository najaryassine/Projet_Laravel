<header id="header" id="home">
    <div class="container">
        <div class="row align-items-center justify-content-between d-flex">
          <div id="logo">
            <a href="index.html"><img src="{{ asset('assets/frontoffice/img/pnglogo.png') }}" width="250" height="50"  /></a>
          </div>
          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="{{ url('/freelancer')}}">Home Freelancer</a></li>
              <li><a href="{{ url('/projects')}}">Projects</a></li>
              <li><a href="about-us.html">Postuler</a></li>
              <li><a href="category.html">Jobs</a></li>
              <li><a href="price.html">Price</a></li>
              <li>
                <ul>
                    <li><a href="elements.html">elements</a></li>
                    <li><a href="search.html">search</a></li>
                    <li><a href="single.html">single</a></li>
                </ul>
              </li>
              <li class="menu-has-children">@if (auth()->user()->avatar == null)
                <img src="{{ asset('../assets/img/noimage.png') }}" class="nav-link text-body font-weight-bold px-0" height="35" width="40">
                @else
                <img class="nav-link text-body font-weight-bold px-0" src="{{ asset('storage/assets/img/' . auth()->user()->avatar) }}" style="border-radius: 50px;" 
                height="40" width="40"  >                    
                @endif 
              <ul>
                <li><a href="{{ url('/profile')}}" class="nav-link text-body font-weight-bold px-0">
                  <i class="fa fa-user me-sm-1"></i><span class="d-sm-inline d-none"> My Profile</span>
                 </a></li>
                <li><a href="{{ url('/logout2')}}" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i><span class="d-sm-inline d-none"> Sign Out</span>
                   </a>
                </li>
              </ul>
            </li>		          				          
            </ul>
          </nav><!-- #nav-menu-container -->		    		
        </div>
    </div>
  </header><!-- #header -->