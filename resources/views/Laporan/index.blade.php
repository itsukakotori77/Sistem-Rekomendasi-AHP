@extends('layouts.app')

@section('content')

    <div class="content">
        <!-- Header -->
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">UMKM Per bulan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tabel UMKM Per bulan</a>
                    </li>
                </ul>
            </div>

            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <div class="card-title">Data UMKM Per bulan</div>
                            </div>
                            
                            <div class="pull-right">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Form Report -->
                                        <form action="{{ url('/laporan/download') }}" method="POST" id="form-laporan">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="Tahun" id="Tahun">
                                            <input type="hidden" name="Tanggal" id="Tanggal">
                                        </form>

                                        <!-- Bulan -->
                                        <div class="dropdown show">
                                            <button class="btn btn-secondary dropdown-toggle btn-xs" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true">
                                                <strong>DOWNLOAD LAPORAN</strong>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                @for($i=1; $i<=12; $i++)
                                                    <?php $tanggal = date('Y-'. $i .'-d'); ?>
                                                    <a class="dropdown-item" onclick="downloadLaporan('{{ date('m-d', strtotime($tanggal)) }}')" href="#">{{ date('F', strtotime($tanggal)) }}</a>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Form Report -->
                                        <form action="{{ url('/laporan') }}" method="POST" id="form-tahun">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="Tanggal" id="Tanggal">
                                        </form>

                                        <!-- Tahun -->
                                        <div class="dropdown show">
                                            <button class="btn btn-secondary dropdown-toggle btn-xs" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true">
                                                <strong>SET TAHUN</strong>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                @for($i=1; $i<=8; $i++)
                                                    <?php $count = 2013 + $i; $tanggal = date($count . '-m-d'); ?>
                                                    <a class="dropdown-item" onclick="ubahTahun('{{ date('Y', strtotime($tanggal)) }}')" href="#">{{ date('Y', strtotime($tanggal)) }}</a>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-head-row">
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="statisticsChart"></canvas>
                                </div>
                                <div id="myChartLegend"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('assets-front/js/bootstrap-growl-master/jquery.bootstrap-growl.js') }}"></script>
    <script src="{{ asset('assets-back/js/moment/moment.min.js') }}"></script>
    <script>

        // Data Array
        data_disetujui = [
            @foreach($data['umkm_disetujui'] as $umkm_disetujui)
                parseInt("{{ $umkm_disetujui }}"),
            @endforeach
        ];

        data_ditolak = [
            @foreach($data['umkm_ditolak'] as $umkm_ditolak)
                parseInt("{{ $umkm_ditolak }}"),
            @endforeach
        ];


        // Data Tanggal
        var tanggal = [];
        for(i=0; i<=30; i++)
        {
            var first = moment().startOf('month').format('MM/DD/YYYY');
            tanggal[i] = moment(first).add(i, 'days').format('MM/DD/YYYY');
        }

        var ctx = document.getElementById('statisticsChart').getContext('2d');

        var statisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [ {
                    label: "Diterima",
                    borderColor: '#177dff',
                    pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(23, 125, 255, 0.4)',
                    legendColor: '#177dff',
                    fill: true,
                    borderWidth: 2,
                    data: data_disetujui,
                }, {
                    label: "Ditolak",
                    borderColor: '#f3545d',
                    pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(243, 84, 93, 0.4))',
                    legendColor: '#f3545d',
                    fill: true,
                    borderWidth: 2,
                    data: data_ditolak
                }]
            },
            options : {
                responsive: true, 
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode:"nearest",
                    intersect: 0,
                    position:"nearest",
                    xPadding:10,
                    yPadding:10,
                    caretPadding:10
                },
                layout:{
                    padding:{left:5,right:5,top:15,bottom:15}
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontStyle: "500",
                            beginAtZero: false,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                }, 
                legendCallback: function(chart) { 
                    var text = []; 
                    text.push('<ul class="' + chart.id + '-legend html-legend">'); 
                    for (var i = 0; i < chart.data.datasets.length; i++) { 
                        text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
                        if (chart.data.datasets[i].label) { 
                            text.push(chart.data.datasets[i].label); 
                        } 
                        text.push('</li>'); 
                    } 
                    text.push('</ul>'); 
                    return text.join(''); 
                }  
            }
        });

        var myLegendContainer = document.getElementById("myChartLegend");

        // generate HTML legend
        myLegendContainer.innerHTML = statisticsChart.generateLegend();

        // bind onClick event to all LI-tags of the legend
        var legendItems = myLegendContainer.getElementsByTagName('li');
        for (var i = 0; i < legendItems.length; i += 1) {
            legendItems[i].addEventListener("click", legendClickCallback, false);
        }

        // Function
        function downloadLaporan(tanggal)
        {
            $('#Tanggal').val(tanggal);
            $('#form-laporan').submit();
        }
        
        function ubahTahun(tahun)
        {
            $('#Tahun').val(tahun);
            setTimeout(function() {
                $.bootstrapGrowl("Tahun diset menjadi" + ' <strong>' + $('#Tahun').val() + '</strong>', {
                    type: 'danger',
                    align: 'right',
                    width: 'auto',
                    allow_dismiss: false
                });
            }, 200);
        }

    </script>

@stop 