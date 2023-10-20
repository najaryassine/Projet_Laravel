<header id="header" id="home">
    <div class="container">
        <div class="row align-items-center justify-content-between d-flex">
          <div id="logo">
            <a href="index.html"><img src="{{ asset('assets/frontoffice/img/pnglogo.png') }}" width="250" height="50"  /></a>
          </div>
          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="index.html">freelancer</a></li>
              <li><a href="about-us.html">Postuler</a></li>
              <li><a href="category.html">Jobs</a></li>
              <li><a href="{{ url('/articles')}}">Articles</a></li>
                <ul>
                    <li><a href="elements.html">elements</a></li>
                    <li><a href="search.html">search</a></li>
                    <li><a href="single.html">single</a></li>
                </ul>
              </li>
              <li>
                <a href="{{ url('/logout2')}}" class="nav-link text-body font-weight-bold px-0">
               <i class="fa fa-user me-sm-1"></i>
               <span class="d-sm-inline d-none">Sign Out</span>
               </a>
             </li>				          				          
            </ul>
          </nav><!-- #nav-menu-container -->		    		
        </div>
    </div>
  </header><!-- #header -->