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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if(isset($data['umkm']))
                                    <table class="table table-hover datatable" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Usaha</th>
                                                <th scope="col">Nama Pemilik Usaha</th>
                                                <th scope="col">Sektor Usaha</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Status</th>
                                                @if($data['umkm']->Status === 3)
                                                    <th scope="col">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $data['umkm']->Nama_Usaha }}</td>
                                                <td>{{ $data['umkm']->Nama_Pemilik_Usaha }}</td>
                                                <td>{{ $data['umkm']->Sektor_Usaha }}</td>
                                                <td>{{ $data['umkm']->Email }}</td>
                                                @if($data['umkm']->Status === 3)
                                                    <td>
                                                        <div class="text-center">
                                                            <span class="badge badge-success"><strong>Menerima Bantuan</strong></span>
                                                        </div>
                                                    </td>
                                                @elseif($data['umkm']->Status === 4) 
                                                    <td>
                                                        <div class="text-center">
                                                            <span class="badge badge-danger"><strong>Tidak Menerima Bantuan</strong></span>
                                                        </div>
                                                    </td>
                                                @elseif($data['umkm']->Status === 1)
                                                    <td>
                                                        <div class="text-center">
                                                            <span class="badge badge-default"><strong>Belum Mendapat Keputusan</strong></span>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td>
                                                        <div class="text-center">
                                                            <span class="badge badge-danger"><strong>Tidak Menerima Bantuan</strong></span>
                                                        </div>
                                                    </td>
                                                @endif
                                                
                                                <!-- Status -->
                                                @if($data['umkm']->Status === 3)
                                                    <td>
                                                        <div class="text-center">
                                                            <form action="{{ url('/umkm/' . $data['umkm']->Kode_Umkm . '/surat') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-info btn-xs"><i class="fas fa-print"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                @else 
                                    <table class="table table-hover datatable" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Usaha</th>
                                                <th scope="col">Nama Pemilik Usaha</th>
                                                <th scope="col">Sektor Usaha</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                @endif 
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
        $(function(){
            $('.datatable').DataTable({
                processing: true,
                responsive: true,
                searching: false, 
                info: false,
                bLengthChange: false,
            });
        })
    </script>

@stop 