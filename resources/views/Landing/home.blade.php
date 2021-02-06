@extends('layouts-front.app')

@section('content')

    <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
            <div class="container text-center text-md-left" data-aos="fade-up">
            <h1 class="text-center"> DINAS KOPERASI USAHA KECIL DAN MENENGAH KABUPATEN BANDUNG BARAT</h1>
            </div>
        </section>
    <!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('assets-front/img/asset-4.jpeg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <h3></h3>
                        <p>
                            Di berbagai daerah, banyak usaha mikro dan kecil terancam gulung tikar. Jangankan mempertahankan kelangsungan usahanya, 
                            untuk memenuhi kebutuhan konsumsi para pelakunya saja sudah nyaris mustahil dilakukan.
                            Meski sebelumnya pemerintah mengucurkan berbagai bantuan kepada UMKM, seperti subsidi bunga pinjaman, insentif pajak, 
                            penjaminan kredit modal kerja baru, Banpres PUM merupakan program tambahan untuk melengkapi insentif sebelumnya.

                            <strong>Adapun tujuan dari bantuan pemerintah untuk umkm adalah :</strong>
                        </p>

                        <ul>
                            <li><i class="bx bx-check-double"></i> Agar UMKM dapat berkembang.</li>
                            <li><i class="bx bx-check-double"></i> Meminimalisir UMKM yang gulung tikar dalam kurun waktu tertentu.</li>
                        </ul>
                        <div class="row icon-boxes">
                        <div class="col-md-6">
                            <i class="bx bx-receipt"></i>
                            <h4>Agar UMKM dapat berkembang</h4>
                            <p>Dimaksudkan untuk UMKM agar terus maju dan dapat bersaing dengan usaha lain</p>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <i class="bx bx-cube-alt"></i>
                            <h4>Meminimalisir UMKM yang gulung tikar</h4>
                            <p>Dimaksudkan agar mengurangi UMKM yang menutup usahanya dikarenakan modal yang tidak cukup untuk menghidupkan usaha mereka</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="count-box">
                            <i class="icofont-simple-smile"></i>
                            <span data-toggle="counter-up">{{ $data['umkm'] }}</span>
                            <p>Daftar UMKM</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div class="count-box">
                            <i class="icofont-document-folder"></i>
                            <span data-toggle="counter-up">{{ $data['diterima'] }}</span>
                            <p>UMKM yang telah terbantu</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Counts Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Syarat Menerima Bantuan Modal Usaha</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="icon-box">
                            <i class="icofont-card"></i>
                            <h4><a href="#">Warga Negara Indonesia (WNI)</a></h4>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4 mt-lg-0">
                        <div class="icon-box">
                            <i class="icofont-simple-smile"></i>
                            <h4><a href="#">Memiliki motivasi tinggi dalam berwirausaha</a></h4>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="icon-box">
                            <i class="icofont-chart-bar-graph"></i>
                            <h4><a href="#">Sudah memiliki usaha minimal 2 tahun</a></h4>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="icon-box">
                            <i class="icofont-document-folder"></i>
                            <h4><a href="#">Memiliki Surat Izin Usaha</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Section -->
    </main>
    <!-- End #main -->    

@endsection 

@push('js')

    <script>
        @if(session('message'))
            $(function() {
                setTimeout(function() {
                    $.bootstrapGrowl("{{ session('message') }}", {
                        type: 'danger',
                        align: 'right',
                        width: 'auto',
                        allow_dismiss: false
                    });
                }, 1000);
            });
        @endif 

    </script>

@endpush