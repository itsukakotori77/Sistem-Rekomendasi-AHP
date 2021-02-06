@extends('layouts.app')

@section('content')

    <div class="content">
        <!-- Header -->
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">User</h4>
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
                        <a href="#">Tabel User</a>
                    </li>
                </ul>
            </div>

            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <div class="card-title">Data User</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
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

@endsection

@section('js')

    <script>

        var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ url('/user') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'avatar', name: 'avatar' },
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'status', name: 'status' },
                    { data: 'aksi', name: 'aksi' },
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

        // Aktif
        function statusAktif(id)
        {
            csrf_token = $('meta[name="csrf_token"]').attr('content');

            $.ajax({
                url : "{{ url('/user') }}" + "/" + id + "/status",
                type : "POST",
                data : {"_method" : "PUT", "_token" : csrf_token},
                success : function(data)
                {
                    var content = {};
                    content.title = 'Sukses';
                    content.message = 'Status user berhasil diubah';
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


    </script>

@stop 