@extends('layouts.app')

@section('content')

    <div class="content">
        <!-- Header -->
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">UMKM</h4>
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
                        <a href="#">Tabel UMKM</a>
                    </li>
                </ul>
            </div>

            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <div class="card-title">Data UMKM</div>
                            </div>
                            <div class="pull-right">
                                <!-- <a href="{{ url('/umkm/import') }}" class="btnweb btn-info btn-sm"><i class="fa fa-plus"></i> <strong>IMPORT CSV</strong></a> -->
                                <a href="{{ url('/umkm/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <strong>TAMBAH UMKM</strong></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Usaha</th>
                                            <th scope="col">Nama Pemilik Usaha</th>
                                            <th scope="col">Sektor Usaha</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('UMKM.modal')

@endsection

@section('js')

    <script>

        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('/umkm') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'Nama_Usaha', name: 'Nama_Usaha' },
                { data: 'Nama_Pemilik_Usaha', name: 'Nama_Pemilik_Usaha' },
                { data: 'Sektor_Usaha', name: 'Sektor_Usaha' },
                { data: 'Email', name: 'Email' },
                { data: 'Aksi', name: 'Aksi' },
            ],
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
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

        function show(id)
        {
            $.ajax({
                url: "{{ url('/umkm') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    // alert(data)
                    // $('#NPWP').text(data.NPWP);
                    if(data.Omzet != null)
                    {
                        $('#Nama_UMKM').text(data.Nama_Usaha);
                        $('#Tahun_Mulai').text(data.Tahun_Mulai);
                        $('#No_Telp').text(data.No_Telp);
                        $('#Jumlah_SDM').text(data.Jumlah_SDM);
                        $('#Total_Aset').text(convertToRupiah(data.Total_Aset));
                        $('#Omzet').text(convertToRupiah(data.Omzet));
                        $('#Wilayah_Pemasaran').text(data.Wilayah_Pemasaran);
                    }else {
                        $('#Nama_UMKM').text(data.Nama_Usaha);
                        $('#Tahun_Mulai').text('Belum Tersedia');
                        $('#No_Telp').text('Belum Tersedia');
                        $('#Jumlah_SDM').text('Belum Tersedia');
                        $('#Total_Aset').text('Belum Tersedia');
                        $('#Omzet').text('Belum Tersedia');
                        $('#Wilayah_Pemasaran').text('Belum Tersedia');
                    }
                    
                    $('#modal').modal('show');
                }
            });
        }

        function convertToRupiah(angka)
        {
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }

    </script>

@stop 