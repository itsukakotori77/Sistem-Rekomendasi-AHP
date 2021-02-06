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
                                <div class="card-title">Data UMKM dengan Kriteria Kecocokan Terbaik</div>
                            </div>
                            <!-- <div class="pull-right">
                                <button type="button" class="btn btn-info btn-sm" onclick="showMatrix()"><i class="fas fa-eye"></i> <strong>LIHAT MATRIKS</strong></button>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Usaha</th>
                                            <th scope="col">Sektor Usaha</th>
                                            <!-- <th scope="col">Komoditi</th> -->
                                            <th scope="col">Skor Kecocokan</th>
                                            <th scope="col">Status</th>
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

    <!-- Form Surat -->
    <form action="" id="form-surat" method="POST">{{ csrf_field() }}</form>

    <!-- Modal -->
    @include('Persetujuan.modal')

@endsection

@section('js')

    <script src="{{ asset('assets-back/js/sweetalert.min.js') }}"></script>
    <script>

        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('/persetujuan') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'Nama_Usaha', name: 'Nama_Usaha' },
                { data: 'Sektor_Usaha', name: 'Sektor_Usaha' },
                // { data: 'Komoditi', name: 'Komoditi' },
                { data: 'Skor_Bantuan', name: 'Skor_Bantuan' },
                { data: 'Status', name: 'Status' },
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

        function showMatrix()
        {
            $('#modal').modal('show');
        }


        // Disetujui
        function disetujui(id)
        {
            csrf_token = $('meta[name="csrf_token"]').attr('content');

            Swal.fire({
                title: 'Attention',
                text: "Apakah anda yakin ingin menyetujui UMKM ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url : "{{ url('/persetujuan') }}" + "/" + id + "/status" + "/disetujui",
                        type : "POST",
                        data : {"_method" : "PUT", "_token" : csrf_token},
                        success : function(data)
                        {
                            var content = {};
                            content.title = 'Sukses';
                            content.message = 'Status UMKM telah diubah menjadi bantuan disetujui';
                            content.icon = 'fa fa-check';
                            content.target = '_blank';
        
                            $.notify(content,{
                                type: 'success',
                                placement: {
                                    from: 'top',
                                    align: 'right'
                                },
                                time: 1000,
                                // delay: 0,
                            });
                            table.ajax.reload();
                        },
                        error : function(error)
                        {
                            swal("Gagal!", "Terjadi kesalahan saat proses perubahan status!", {
                                icon : "error",
                                buttons: {        			
                                    confirm: {
                                        className : 'btn btn-danger'
                                    }
                                },
                            });
                            console.log(error);
                        }
                    });
                }
            })

        }

        // Ditolak
        function ditolak(id)
        {
            csrf_token = $('meta[name="csrf_token"]').attr('content');

            Swal.fire({
                title: 'Attention',
                text: "Apakah anda yakin ingin menolak UMKM ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url : "{{ url('/persetujuan') }}" + "/" + id + "/status" + "/ditolak",
                        type : "POST",
                        data : {"_method" : "PUT", "_token" : csrf_token},
                        success : function(data)
                        {
                            var content = {};
                            content.title = 'Sukses';
                            content.message = 'Status UMKM telah diubah menjadi bantuan tidak disetujui';
                            content.icon = 'fa fa-check';
                            content.target = '_blank';
        
                            $.notify(content,{
                                type: 'success',
                                placement: {
                                    from: 'top',
                                    align: 'right'
                                },
                                time: 1000,
                                // delay: 0,
                            });
                            table.ajax.reload();
                        },
                        error : function(error)
                        {
                            swal("Gagal!", "Terjadi kesalahan saat proses perubahan status!", {
                                icon : "error",
                                buttons: {        			
                                    confirm: {
                                        className : 'btn btn-danger'
                                    }
                                },
                            });
                            console.log(error);
                        }
                    });
                }
            })

        }

        function buatSurat(id)
        {
            Swal.fire({
                title: 'Attention',
                text: "Apakah anda yakin ingin membuat surat?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $('#form-surat').attr('action', "{{ url('/persetujuan') }}" + "/" + id + "/ajukan");
                    $('#form-surat').submit();

                    $.ajax({
                        url: "{{ url('/persetujuan') }}",
                        type: "GET",
                        success: function(response)
                        {
                            table.ajax.reload();
                        }
                    });
                }
            })
        }

    </script>

@stop 