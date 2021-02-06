@extends('layouts.app')

@section('content')

    <div class="content">
        <!-- Header -->
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Staff UMKM</h4>
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
                        <a href="#">Tabel Staff UMKM</a>
                    </li>
                </ul>
            </div>

            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <div class="card-title">Data Staff UMKM</div>
                            </div>
                            
                            <div class="pull-right">
                                <a href="{{ url('/pengurus/create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i><strong> TAMBAH</strong></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jabatan</th>
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

    <!-- Modal -->
    @include('Pengurus.modal')

@endsection

@section('js')

    <script>

        $(function(){
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ url('/pengurus') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'Foto', name: 'Foto' },
                    { data: 'Username', name: 'Username' },
                    { data: 'email', name: 'email' },
                    { data: 'Nama', name: 'Nama' },
                    { data: 'Jabatan', name: 'Jabatan' },
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

        function showData(id)
        {
            // Ajax
            $.ajax({
                url: "{{ url('/pengurus') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#Nama_Depan').val(data.Nama_Depan);
                    $('#Nama_Belakang').val(data.Nama_Belakang);
                    $('#Alamat').val(data.Alamat);

                    // IMG
                    if(data.Foto == '')
                        $('#Foto-User').attr('src', "{{ asset('assets-back/img/foto-user/user.png') }}");
                    else 
                        $('#Foto-User').attr('src', "{{ asset('assets-back/img/foto-user/') }}" + "/" + data.Foto);

                    $('#modal').modal('show');
                }
            });
        }

    </script>

@stop 