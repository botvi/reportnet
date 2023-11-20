<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/css/bootstrap.css">

    <link rel="stylesheet" href="{{ asset('dist') }}/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="{{ asset('dist') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/css/app.css">
    <link rel="shortcut icon" href="{{ asset('dist') }}/assets/images/favicon.svg" type="image/x-icon">
    {{-- DATATABLES --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

    @yield('style')

    {{-- MAPS LETFLET --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>

<body>
    <div id="app">
        @include('template.navbar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            @yield('content')

        </div>
    </div>
    @yield('modal')

    <script src="{{ asset('dist') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('dist') }}/assets/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('dist') }}/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="{{ asset('dist') }}/assets/js/pages/dashboard.js"></script>

    <script src="{{ asset('dist') }}/assets/js/main.js"></script>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentLocation = window.location.pathname;
    
            var menuItems = document.querySelectorAll('.sidebar-item');
    
            menuItems.forEach(function(item) {
                var itemLink = item.querySelector('.sidebar-link');
                var itemURL = itemLink.getAttribute('href');
    
                if (currentLocation === itemURL) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    

    @yield('script')

</body>

</html>
