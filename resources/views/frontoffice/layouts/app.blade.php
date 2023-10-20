<!DOCTYPE html>

  <html lang="zxx" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav.png">
  <!-- Author Meta -->
  <meta name="author" content="codepixer">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <title>
    Freelance
  </title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<link rel="stylesheet" href="../assets/frontoffice/css/linearicons.css">
			<link rel="stylesheet" href="../assets/frontoffice/css/font-awesome.min.css">
			<link rel="stylesheet" href="../assets/frontoffice/css/bootstrap.css">
			<link rel="stylesheet" href="../assets/frontoffice/css/magnific-popup.css">
			<link rel="stylesheet" href="../assets/frontoffice/css/nice-select.css">					
			<link rel="stylesheet" href="../assets/frontoffice/css/animate.min.css">
			<link rel="stylesheet" href="../assets/frontoffice/css/owl.carousel.css">
			<link rel="stylesheet" href="../assets/frontoffice/css/main.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>


<body class="g-sidenav-show  bg-gray-100 ">
  @auth
    @yield('auth')
  @endauth
  @guest
    @yield('guest')
  @endguest

  @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif
  <script src="../assets/frontoffice/js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="../assets/frontoffice/js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="../assets/frontoffice/js/easing.min.js"></script>			
			<script src="../assets/frontoffice/js/hoverIntent.js"></script>
			<script src="../assets/frontoffice/js/superfish.min.js"></script>	
			<script src="../assets/frontoffice/js/jquery.ajaxchimp.min.js"></script>
			<script src="../assets/frontoffice/js/jquery.magnific-popup.min.js"></script>	
			<script src="../assets/frontoffice/js/owl.carousel.min.js"></script>			
			<script src="../assets/frontoffice/js/jquery.sticky.js"></script>
			<script src="../assets/frontoffice/js/jquery.nice-select.min.js"></script>			
			<script src="../assets/frontoffice/js/parallax.min.js"></script>		
			<script src="../assets/frontoffice/js/mail-script.js"></script>	
			<script src="../assets/frontoffice/js/main.js"></script>	
  {{-- @stack('rtl')
  @stack('dashboard')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script> --}}
</body>

</html>
