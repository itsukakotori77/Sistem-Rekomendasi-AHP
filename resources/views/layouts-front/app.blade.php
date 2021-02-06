<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Bantuan Pemerintah UMKM</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets-front/img/logo.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets-front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-front/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-front/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-front/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-front/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets-front/css/style.css') }}" rel="stylesheet">

    @stack('css')
</head>

<body>

    <!-- ======= Header ======= -->
    @include('layouts-front.navbar')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts-front.footer')

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Form Logout -->
    <form action="{{ url('/logout') }}" id="form-logout" method="POST">{{ csrf_field() }}</form>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets-front/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets-front/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/bootstrap-growl-master/jquery.bootstrap-growl.js') }}"></script>

    <!-- Custom JS -->
    @stack('js')

    <!-- Template Main JS File -->
    <script src="{{ asset('assets-front/js/main.js') }}"></script>
    <script>
        function logout()
        {
            $('#form-logout').submit();
        }
    </script>

</body>

</html>