<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
        <div class="logo mr-auto">
            <h1>
                <a href="#">
                    <img src="{{ asset('assets-front/img/logo.png') }}" alt=""> Dinas KBB
                </a>
            </h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
        <ul>
            @if(Request::is('/'))
                <li class="active"><a href="#hero">Home</a></li>
                <li><a href="#services">Syarat</a></li>
                <li class="drop-down"><a href="#">Tentang</a>
                    <ul>
                        <li><a href="{{ url('/about') }}">Tentang</a></li>
                        <li><a href="{{ url('/about') }}">Visi Misi</a></li>
                    </ul>
                </li>
                @if(Auth::check())
                    <li><a onclick="logout()" href="#">Logout</a></li>
                @else 
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Daftar</a></li>
                @endif
            @else 
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="drop-down"><a href="#">Tentang</a>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#tentang" class="nav-link active" role="tab" data-toggle="tab">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a href="#visi-misi" class="nav-link" role="tab" data-toggle="tab">Visi Misi</a>
                        </li>
                    </ul>
                </li>
                @if(Auth::check())
                    <li><a onclick="logout()" href="#">Logout</a></li>
                @else 
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Daftar</a></li>
                @endif
            @endif

        </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->