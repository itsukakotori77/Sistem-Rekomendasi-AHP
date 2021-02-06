<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        
        <a href="#" class="logo">
            <img src="{{ asset('assets-back/img/logo.png') }}" alt="navbar brand" class="navbar-brand" style="width: 50px;">
            <span style="margin-left: 10px; color:white;" class="font-proxima"><strong>Dinas Koperasi</strong></span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if(Auth::user()->avatar == '')
                                <img src="{{ asset('assets-back/img/foto-user/user.png') }}" alt="..." class="avatar-img rounded-circle">
                            @else 
                                <img src="{{ asset('assets-back/img/foto-user/' . Auth::user()->avatar) }}" alt="..." class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if(Auth::user()->avatar == '')
                                            <img src="{{ asset('assets-back/img/foto-user/user.png') }}" alt="image profile" class="avatar-img rounded">
                                        @else 
                                            <img src="{{ asset('assets-back/img/foto-user/' . Auth::user()->avatar) }}" alt="image profile" class="avatar-img rounded">
                                        @endif 
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->username }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p><a href="{{ url('/profile/' . Auth::user()->id) }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" onclick="logout()" href="#">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>