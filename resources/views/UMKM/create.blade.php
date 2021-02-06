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
                                <a href="{{ url('/umkm') }}" class="btn btn-info btn-sm"><strong>KEMBALI</strong></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form action="{{ url('/umkm') }}" method="POST" id="form-umkm" autocomplete="off">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- UMKM -->
                                            <div class="form-group">
                                                <label for="">Pilih UMKM <span style="color: #FF0000">*</span></label>
                                                <select name="UMKM" id="UMKM" class="form-control" required>
                                                    <option disabled selected="selected">-- Pilih --</option>
                                                    @foreach($data['umkm'] as $umkm)
                                                        <option value="{{ $umkm->Kode_Umkm }}">{{ $umkm->Nama_Usaha . ' ' . $umkm->Nama_Pemilik_Usaha }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- Jumlah SDM -->
                                            <div class="form-group">
                                                <label for="">Jumlah SDM <span style="color: #FF0000">*</span></label>
                                                <input type="text" required class="form-control only-number" name="Jumlah_SDM" id="Jumlah_SDM" placeholder="Jumlah SDM">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Total Aset -->
                                            <div class="form-group">
                                                <label for="">Total Aset <span style="color: #FF0000">*</span></label>
                                                <input type="text" required class="form-control only-number" name="Total_Aset" id="Total_Aset" placeholder="Total Aset">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Omzet -->
                                            <div class="form-group">
                                                <label for="">Omzet <span style="color: #FF0000">*</span></label>
                                                <input type="text" required class="form-control only-number" name="Omzet" id="Omzet" placeholder="Omzet">
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Button -->
                                    <div class="pull-right">
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-danger btn-sm"><strong>RESET</strong></button>
                                            <button type="submit" class="btn btn-success btn-sm"><strong>SIMPAN</strong></button>
                                        </div>
                                    </div>

                                </form>
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

        $('#form-umkm').validate({
            errorElement: 'label',
            errorPlacement: function (error, element) {
                error.addClass('form-text text-muted');
                element.closest('.form-group').append(error);
            },
        });

    </script>

@stop 

