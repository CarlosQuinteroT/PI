<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  
<!--    METAS DE LA PLANTILLA PRINCIPAL-->
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="admin/assets/img/iconoPag.ico">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">
    <link href="css/plantilla.css" rel="stylesheet">
<!--    TERMINA LA PLATNILLA PRINCIPAL-->
  
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <title>
    Cisco Networking Academy Builds IT Skills & Education For Future Careers
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="admin2/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="admin2/assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="admin2/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="" >
  <div class="wrapper " id="app">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="admin2/assets/img/cisco.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          <span style="font-size:13px;">Networking Academy</span>
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      
      
<!--   SIDEBAR      -->
      @if(Auth::check())
            @if (Auth::user()->idrol == 1)
                @include('plantilla.sidebaradministrador')
            @elseif (Auth::user()->idrol == 2)
                @include('plantilla.sidebarcontacto')
            @else

            @endif

        @endif
<!--  TERMINA EL SIDEBAR  -->
      
    </div>
                      <!-- AQUI TERMINA EL SIDEBAR -->



    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper" style="color:#365990;">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Cisco Networking Academy</a>
            <a class="nav-link dropdown-toggle nav-link" data-toggle="" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="margin-left:680px;">
                    <img src="img/avatars/1.png" class="img-avatar" >
                    <span class="d-md-down-none">{{Auth::user()->usuario}} </span>
                </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
        
            <ul class="nav navbar-nav ml-auto">            
            <li class="nav-item dropdown">
              <div class="row">    
              
                
                    
                    <a class="mt-1" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i>&nbsplogout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">


</div> -->
      
       <div class="content">
       @yield('contenido')
       </div>
   
   
   
      
      
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">

            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, Hecho por: Carlos Morin - Carlos Quintero - Carlos de los Reyes
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
    
    
    
  </div>
  <!--   Core JS Files   -->
  <script src="admin2/assets/js/core/jquery.min.js"></script>
  <script src="admin2/assets/js/core/popper.min.js"></script>
  <script src="admin2/assets/js/core/bootstrap.min.js"></script>
  <script src="admin2/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="admin2/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="admin2/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="admin2/assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="admin2/assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
    
    
  </script>
  
   <script src="js/app.js"></script>
   <script src="js/plantilla.js"></script>
</body>

</html>
