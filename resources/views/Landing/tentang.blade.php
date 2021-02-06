@extends('layouts-front.app')

@push('css')

    <style>
        article {
            max-height: 6em; /* (4 * 1.5 = 6) */
        }
        @media screen and (min-width: 640px) {
            article {
                max-height: 12em;
            }
        }
    </style>

@endpush 

@section('content')

    <main id="main">
        <!-- ======= About Section ======= -->
            <section id="about" class="about" style="margin-top: 100px; height: 800px;">
                <div class="tab-content">
                    <!-- Tab 1 -->
                    <div role="tabpanel" class="container tab-pane active" id="tentang">
                        <div class="row">
                            <div class="col-lg-12 pt-4 pt-lg-0">
                                <h3>Tentang</h3>
                                <p>
                                    Menurut UUD 1945 kemuadian dikuatkan melalui TAP MPR NO.XVI/MPR-RI/1998 tentang Politik Ekonomi dalam rangka Demokrasi Ekonomi, 
                                    Usaha Mikro, Kecil, dan Menengah perlu diberdayakan sebagai bagian integral ekonomi rakyat yang mempunyai kedudukan, peran, dan 
                                    potensi strategis untuk mewujudkan struktur perekonomian nasional yang makin seimbang, berkembang, dan berkeadilan. Selanjutnya dibuatlah 
                                    pengertian UMKM melalui UU No.9 Tahun 1999 dan karena keadaan perkembangan yang semakin dinamis diubah ke Undang-Undang 
                                    No.20 Pasal 1 Tahun 2008 tentang Usaha Mikro, Kecil dan Menengah maka pengertian UMKM adalah sebagai berikut
                                </p>
                                <ul>
                                    <li><i class="bx bx-check-double"></i> UMKM dapat berkembang.</li>
                                    <li><i class="bx bx-check-double"></i> Meminimalisir UMKM yang gulung tikar dalam kurun waktu tertentu.</li>
                                </ul>
                                <div class="row icon-boxes">
                                    <div class="col-md-4">
                                        <i class="bx bx-receipt"></i>
                                        <h4>USAHA MIKRO</h4>
                                        <article>
                                            <p>
                                                Usaha Mikro adalah usaha produktif milik orang perorangan dan/atau badan usaha perorangan yang memenuhi kriteria Usaha Mikro sebagaimana
                                                diatur dalam Undang-Undang ini. Memiliki kekayaan bersih paling banyak Rp. 50.000.000,00 (lima puluh juta rupiah) tidak termasuk tanah dan
                                                bangunan tempat usaha, serta memiliki hasil penjualan tahunan paling banyak Rp. 300.000.000,00 (tiga ratus juta rupiah).
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-md-4">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4>USAHA KECIL</h4>
                                        <article>
                                            <p>
                                                Usaha Kecil adalah usaha ekonomi produktif yang berdiri sendiri, yang dilakukan oleh orang perorangan atau badan usaha yang bukan merupakan anak 
                                                perusahaan atau bukan cabang perusahaan yang dimiliki, dikuasai, atau menjadi bagian baik langsung maupun tidak langsung dari Usaha Menengah atau 
                                                Usaha Besar yang memenuhi kriteria Usaha Kecil sebagaimana dimaksud dalam Undang-Undang ini. Memiliki kekayaan bersih lebih dari Rp. 50.000.000,00 
                                                (lima puluh juta rupiah) sampai dengan paling banyak Rp. 500.000.000,00 (lima ratus juta rupiah) tidak termasuk tanah dan bangunan tempat usaha serta 
                                                memiliki penjualan tahunan lebih dari banyak Rp. 300.000.000,00 (tiga ratus juta rupiah) sampai dengan paling banyak Rp.2.500.000.000,00 
                                                (dua milyar lima ratus ribu rupiah).
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-md-4">
                                        <i class="bx bx-book-add"></i>
                                        <h4>USAHA MENENGAH</h4>
                                        <article>
                                            <p>
                                                Usaha Menengah adalah usaha ekonomi yang produktif yang berdiri sendiri yang dilakukan oleh orang perorangan atau badan usaha yang bukan merupakan anak 
                                                perusahaan atau cabang perusahaan yang dimiliki, dikuasai atau menjadi bagian baik langsung maupun tidak langsung dengan usaha kecil atau usaha besar dengan 
                                                jumlah kekayaan bersih atau hasil penjualan tahunan sebagaimana diatur dalam Undang-Undang ini. Memiliki kekayaan bersih lebih dari Rp. 500.000.000,00 
                                                (lima ratus juta rupiah) sampai paling banyak Rp. 10.000.000.000 (sepuluh milyar rupiah) tidak termasuk tanah dan bangunan tempat usaha serta memiliki 
                                                penjualan tahunan lebih dari Rp.2.500.000.000,00 (dua milyar lima ratus ribu rupiah) sampai paling banyak Rp. 50.000.000.000,00 (lima puluh milyar rupiah).
                                            </p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2 -->
                    <div role="tabpanel" class="container tab-pane fade" id="visi-misi">
                        <div class="row">
                            <div class="col-lg-12 pt-4 pt-lg-0">
                                <h3>Visi Misi</h3>
                                <p>Pemerintah Daerah Kabupaten Bandung Barat mempunyai visi dan misi sebagai berikut:</p>
                                <div class="row icon-boxes" style="margin-top: 50px;">
                                    <div class="col-md-6">
                                        <i class="bx bx-receipt"></i>
                                        <h4>Visi</h4>
                                        <article>
                                            <p>
                                                “Bandung Barat yang AKUR (Aspiratif, Kreatif, Unggul dan Religius), dan berbasis pada pengembangan ekonomi, 
                                                optimalisasi sumber daya alam dan kualitas sumber daya manusia”
                                            </p>
                                            <ol>
                                                <li>Aspiratif Pemerintah Bandung Barat yang aspiratif akan selalu mendengarkan dan menghargai menghargai harapan, keinginan, cita-cita, dan kemampuan masyarakat.</li>
                                                <li>Kreatif Penyelenggaraan Pemerintahan di Bandung Barat dilaksanakan dengan terobosan dan menggunakan gagasan yang out of the box dan orisinil dalam rangka memenuhi kepentingan masyarakat melalui melalui pembangunan yang ramah lingkungan serta mematuhi seluruh peraturan yang berlaku.</li>
                                                <li>Unggulan Bandung Barat harus diarahkan agar memiliki kemampuan dan kekuatan berdasarkan potensi yang ada untuk bersaing, memiliki kekelebihan komparatif dan kompetitif.</li>
                                                <li>Religius Masyarakat Kabupaten Bandung Barat diharapkan memiliki dan terikat dengan nilai-nilai, norma, semangat dan kaidah agama.</li>
                                            </ol>
                                        </article>
                                    </div>
                                    <div class="col-md-6">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4>Misi</h4>
                                        <article>
                                            <ol>
                                                <li>Membangun Sumber Daya Manusia yang berkualitas melalui jaminan akses dan pemerataan terhadap layanan dasar kesehatan, pendidikan, dan keagamaan.</li>
                                                <li>Memenuhi kebutuhan infrastruktur dasar sebagai penunjang mobilitas masyarakat dan pengembangan ekonomi, sosial, dan budaya.</li>
                                                <li>Menumbuhkan pusat-pusat pertumbuhan ekonomi masyarakat berbasis kearifan lokal dan kreativitas.</li>
                                                <li>Melakukan optimalisasi potensi sumber daya alam dan budaya untuk pengembangan pariwisata ramah lingkungan.</li>
                                                <li>Menguatkan keunggulan pertanian, peternakan, dan industri yang merata melalui optimalisasi ilmu pengetahuan dan teknologi.</li>
                                                <li>Mengurangi kesenjangan masyarakat dengan kebijakan yang pro-poor, projob, pro-growth, dan pro-environment.</li>
                                                <li>Mengembangkan sistem Pemerintahan yang bersih, aspiratif, inovatif dan melayani berbasis inovasi dan teknologi.</li>
                                            </ol>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- End About Section -->
    </main>
    <!-- End #main -->  


    <!-- <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#references" role="tab" data-toggle="tab">Setting</a>
        </li>
    </ul> -->

    <!-- Tab panes -->
    <!-- <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="profile">Ini Halaman Home</div>
        <div role="tabpanel" class="tab-pane fade" id="buzz">Ini Halaman Profile</div>
        <div role="tabpanel" class="tab-pane fade" id="references">Ini Halaman Setting</div>
    </div> -->
      
    
@endsection

@push('js')

    <script src="{{ asset('assets-back/js/readmore/readmore.js') }}"></script>
    <script>
        // $('article').readmore({
        //     afterToggle: function(trigger, element, expanded) {
        //         if(! expanded) { // The "Close" link was clicked
        //         $('html, body').animate( { scrollTop: element.offset().top }, {duration: 100 } );
        //         }
        //     }
        // });
        // $('article').readmore({
        //     speed: 500,
        //     collapsedHeight:200,
        //     collapsedMoreHeight: 400, // Always bigger than collapsedHeigh. There isn't any control to that. Be careful.
        //     moreLink: '<a class="white-shadow" href="#">More information</a>',
        //     evenMoreLink: '<a class="white-shadow" href="#">Even More informations</a>', // Add new label
        //     lessLink: '<a href="#">Less information</a>'
        // });
        // $('article').readmore({
        //     moreLink: '<a href="#">Usage, examples, and options</a>',
        //     collapsedHeight: 200,
        //     afterToggle: function(trigger, element, expanded) {
        //         if(! expanded) { // The "Close" link was clicked
        //             $('html, body').animate({scrollTop: element.offset().top}, {duration: 100});
        //         }
        //     }
        // });

        // $('article').readmore({speed: 500});
    </script>

@endpush