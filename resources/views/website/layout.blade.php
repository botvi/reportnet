<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Diskominfos | Landing &amp; Corporate Template</title>

       {{-- DATATABLES --}}
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
       <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
       <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
       <link rel="stylesheet" href="{{ asset('dist') }}/assets/vendors/bootstrap-icons/bootstrap-icons.css">


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('web/public') }}/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('web/public') }}/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('web/public') }}/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/public') }}/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="{{ asset('web/public') }}/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="{{ asset('web/public') }}/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('web/public') }}/assets/css/theme.css" rel="stylesheet" />

  </head>


  <body>
    <!-- Main Content -->
    <main class="main" id="top">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('web/public') }}/assets/img/icons/logo.png" alt="" width="30" />
                    <span class="text-1000 fs-1 ms-2 fw-medium">Diskom<span class="fw-bold">infos</span></span>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pengaduan') ? 'active' : '' }}" href="/pengaduan">Pengaduan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome, {{ Auth::user()->name }}</a>
                        </li>
                        @endauth
                    </ul>
                    <form class="d-flex py-3 py-lg-0">
                        @auth
                            <!-- Show user's name and Logout button when the user is logged in -->
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger rounded-pill order-0">Logout</a>
                        @else
                            <!-- Show Sign In button when the user is not logged in -->
                            <a href="/login" class="btn btn-outline-danger rounded-pill order-0" type="submit">Sign In</a>
                        @endauth
                    </form>
                    
                    
                </div>
            </div>
        </nav>

        <!-- Content section -->
        @yield('content')

        <!-- JavaScripts -->
        <script src="{{ asset('web/public') }}/vendors/@popperjs/popper.min.js"></script>
        <script src="{{ asset('web/public') }}/vendors/bootstrap/bootstrap.min.js"></script>
        <script src="{{ asset('web/public') }}/vendors/is/is.min.js"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="{{ asset('web/public') }}/assets/js/theme.js"></script>

        

        @yield('script')
        
    {{-- DATATABLES --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        new DataTable('#example', {
            responsive: true
        });
    </script>


        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

        <!-- Custom Script -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var navLinks = document.querySelectorAll(".navbar-nav a");

                navLinks.forEach(function (link) {
                    link.addEventListener("click", function () {
                        navLinks.forEach(function (navLink) {
                            navLink.classList.remove("active");
                        });

                        this.classList.add("active");
                    });
                });
            });
        </script>
    </main>
</body>

</html>