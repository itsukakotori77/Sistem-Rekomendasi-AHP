@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Dinas Koperasi Usaha Kecil dan Menengah</h5>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->role_id === 1 || Auth::user()->role_id === 4)
            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-md-6">
                        <div class="card full-height">
                            <div class="card-body">
                                <div class="card-title">Statistik Staff UMKM</div>
                                <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-1"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Staff UMKM</h6>
                                    </div>
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-2"></div>
                                        <h6 class="fw-bold mt-3 mb-0">UMKM yang menerima bantuan</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card full-height">
                            <div class="card-body">
                                <div class="card-title">Total umkm yang menerima bantuan</div>
                                <div class="row py-3">
                                    <div class="col-md-4 d-flex flex-column justify-content-around">
                                        <div>
                                            <h6 class="fw-bold text-uppercase text-success op-8">UMKM menerima bantuan</h6>
                                            <h3 class="fw-bold">{{ $data['diterima'] }}</h3>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-uppercase text-danger op-8">UMKM tidak menerima bantuan</h6>
                                            <h3 class="fw-bold">{{ $data['ditolak'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="chart-container">
                                            <canvas id="totalIncomeChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data User -->
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row card-tools-still-right">
                                    <h4 class="card-title">Data User</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive table-hover table-sales">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama</th>
                                                        <th>Jabatan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['pengurus'] as $pengurus)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $pengurus->Nama_Depan . ' ' . $pengurus->Nama_Belakang }}</td>
                                                            <td>{{ $pengurus->Role }}</td>
                                                            <td>
                                                                @if($pengurus->status == 1)
                                                                    <div class="text-center">
                                                                        <span class="badge badge-success"><strong>Aktif</strong></span>
                                                                    </div>
                                                                @else 
                                                                    <div class="text-center">
                                                                        <span class="badge badge-danger"><strong>Tidak Aktif</strong></span>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @elseif(Auth::user()->role_id === 2 || Auth::user()->role_id === 3)
            <div class="page-inner mt--5">
                <div class="card">
                    <marquee behavior="" direction=""> <h1>Selamat Datang <strong>{{ Auth::user()->username }}</strong></h1></marquee>
                </div>
            </div>
        @endif 
    </div>

@endsection 

@section('js')

    <script>

	    Circles.create({
			id:'circles-1',
			radius: 45,
			value: parseInt("{{ $data['jumlah_staff'] }}"),
			maxValue: parseInt("{{ $data['jumlah_pengurus'] }}"),
			width:7,
			text: parseInt("{{ $data['jumlah_staff'] }}"),
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value :parseInt("{{ $data['diterima'] }}"),
			maxValue: parseInt("{{ $data['jumlah_umkm'] }}"),
			width:7,
			text: parseInt("{{ $data['diterima'] }}"),
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
        })
        

        // Data Charts
        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');
		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				// labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				labels: ["Kuliner", "Fashion", "Perdagangan", "Pertanian"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [
                        parseInt("{{ $data['kuliner'] }}"), 
                        parseInt("{{ $data['fashion'] }}"), 
                        parseInt("{{ $data['perdagangan'] }}"), 
                        parseInt("{{ $data['pertanian'] }}")
                    ],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
        });
        
        @if(session('message'))
            var content = {};
            content.title = 'Notifikasi';
            content.message = '{{ session("message") }}';
            content.icon = 'fa fa-bell';
            content.target = '_blank';

            $.notify(content,{
                type: 'success',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                time: 3000,
                delay: 0,
            });
        @endif

    </script>

@stop 