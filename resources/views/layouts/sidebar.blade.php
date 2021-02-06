<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if(Auth::user()->avatar == '')
                        <img src="{{ asset('assets-back/img/foto-user/user.png') }}" class="avatar-img rounded-circle">
                    @else 
                        <img src="{{ asset('assets-back/img/foto-user/' . Auth::user()->avatar) }}" class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->username }}

                            <!-- Condition -->
                            @if(Auth::user()->role_id == 1)
                                <span class="user-level">Admin</span>
                            @elseif(Auth::user()->role_id == 2)
                                <span class="user-level">Staff UMKM</span>
                            @elseif(Auth::user()->role_id == 3)
                                <span class="user-level">Pelaku Usaha</span>
                            @else 
                                <span class="user-level">Kepala Dinas</span>
                            @endif
                            
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                @if(Auth::user()->role_id === 1)
                    <!-- Admin -->
                        <!-- Modul 2 -->
                            <li class="nav-item {{ setActive(['dashboard*']) }}">
                                <a href="{{ url('/dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        <!-- End of Modul 2 -->

                        <!-- Modul 1 -->
                            <!-- User -->
                            <li class="nav-item {{ setActive(['user*']) }}">
                                <a href="{{ url('/user') }}">
                                    <i class="fas fa-users"></i>
                                    <p>User</p>
                                </a>
                            </li>

                            <!-- User -->
                            <!-- <li class="nav-item">
                                <a data-toggle="collapse" href="#user" class="collapsed" aria-expanded="false">
                                    <i class="fas fa-users"></i>
                                    <p>User</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="user">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Staff UMKM</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">UMKM</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> -->

                            <!-- Pengurus -->
                            <li class="nav-item {{ setActive(['pengurus*']) }}">
                                <a href="{{ url('/pengurus') }}">
                                    <i class="fas fa-user-tie"></i>
                                    <p>Staff UMKM</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item {{ setActive(['umkm*']) }}">
                                <a href="{{ url('/umkm') }}">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <p>Daftar UMKM</p>
                                </a>
                            </li> -->
                        <!-- End of Modul 1 -->

                        <!-- Modul 3 -->
                            <!-- <li class="nav-item {{ setActive(['persetujuan*']) }}">
                                <a href="{{ url('/persetujuan') }}">
                                    <i class="fas fa-check-double"></i>
                                    <p>Persetujuan Bantuan</p>
                                </a>
                            </li> -->
                        <!-- End of modul 3 -->

                        <!-- Modul 4 -->
                            <!-- <li class="nav-item {{ setActive(['laporan*']) }}">
                                <a href="{{ url('/laporan') }}">
                                    <i class="fas fa-chart-bar"></i>
                                    <p>Laporan</p>
                                </a>
                            </li> -->
                        <!-- End of modul 4 -->

                    <!-- End of Admin -->
                @elseif(Auth::user()->role_id === 2)
                    <!-- Modul 2 -->
                        <li class="nav-item {{ setActive(['dashboard*']) }}">
                            <a href="{{ url('/dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item {{ setActive(['umkm*']) }}">
                            <a href="{{ url('/umkm') }}">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>Daftar UMKM</p>
                            </a>
                        </li>
                    <!-- End of Modul 2 -->

                @elseif(Auth::user()->role_id === 4)
                    <li class="nav-item {{ setActive(['dashboard*']) }}">
                        <a href="{{ url('/dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item {{ setActive(['umkm*']) }}">
                        <a href="{{ url('/umkm') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Daftar UMKM</p>
                        </a>
                    </li> -->
                    <!-- Modul 3 -->
                        <li class="nav-item {{ setActive(['persetujuan*']) }}">
                            <a href="{{ url('/persetujuan') }}">
                                <i class="fas fa-check-double"></i>
                                <p>Persetujuan Bantuan</p>
                            </a>
                        </li>
                    <!-- End of modul 3 -->

                    <!-- Modul 4 -->
                        <li class="nav-item {{ setActive(['laporan*']) }}">
                            <a href="{{ url('/laporan') }}">
                                <i class="fas fa-chart-bar"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    <!-- End of modul 4 -->
                @elseif(Auth::user()->role_id === 3)
                    <!-- Dashboard -->
                    <li class="nav-item {{ setActive(['dashboard*']) }}">
                        <a href="{{ url('/dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- UMKM -->
                    <li class="nav-item {{ setActive(['persyaratan*']) }}">
                        <a href="{{ url('/persyaratan/' . Auth::user()->id . '/umkm') }}">
                            <i class="fas fa-file"></i>
                            <p>Persyaratan</p>
                        </a>
                    </li>
                    <!-- Modul 5 -->
                        <li class="nav-item {{ setActive(['personal*']) }}">
                            <a href="{{ url('/personal/' . Auth::user()->id . '/umkm') }}">
                                <i class="fas fa-chart-bar"></i>
                                <p>Hasil Pengajuan</p>
                            </a>
                        </li>
                    <!-- End of modul 5 -->
                @endif
                
                <!-- Modul 2 -->
                <!-- Modul -->
            </ul>
        </div>
    </div>
</div>