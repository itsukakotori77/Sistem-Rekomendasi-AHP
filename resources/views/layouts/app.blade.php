<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Sistem Pendukung Keputusan Bantuan | Kabupaten Bandung Barat</title>
    <meta content="{{ csrf_token() }}" name="csrf_token">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!-- CSS -->
    @include('layouts.linkcss')

    <!-- Custom CSS -->
    @section('css')
    @show
</head>
<body>
    <!-- Form Logout -->
    <form action="{{ url('/logout') }}" method="POST" id="formLogout">{{ csrf_field() }}</form>
	<div class="wrapper">
        
        <!-- Navbar -->
        @include('layouts.navbar')

		<!-- Sidebar -->
        @include('layouts.sidebar')

		<div class="main-panel">
            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')
		</div>
    </div>
    
    <!-- JS -->
    @include('layouts.linkjs')

    <!-- Custom Script -->
    @section('js')
    @show 
</body>
</html>