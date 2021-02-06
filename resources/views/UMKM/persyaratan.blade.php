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
                                <div class="card-title">Data UMKM {{ $data['umkm']->Nama_Usaha }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form action="{{ url('/persyaratan/' . $data['umkm']->Kode_Umkm . '/umkm') }}" method="POST" id="form-persyaratan" autocomplete="OFF" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <!-- Baris 1 -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- KTP -->
                                            <div class="form-group">
                                                <label for="">KTP  <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control only-number" minlength="16" maxlength="16" name="KTP" id="KTP" required placeholder="KTP" value="{{ $data['umkm']->KTP }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Sektor Usaha -->
                                            <div class="form-group">
                                                <label for="">Sektor Usaha  <span style="color: #FF0000;">*</span></label>
                                                <select name="Sektor_Usaha" id="Sektor_Usaha" class="form-control" required>
                                                    <option disabled selected="selected">-- Pilih Sektor --</option>
                                                    @foreach($data['data_usaha'] as $data_usaha)
                                                        <option value="{{ $data_usaha->Kode_Sektor }}" @if($data['umkm']->Sektor_Usaha === $data_usaha->Kode_Sektor) selected="selected" @endif>{{ $data_usaha->Sektor_Usaha }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Desa -->
                                            <div class="form-group">
                                                <label for="">Kelurahan  <span style="color: #FF0000;">*</span></label>
                                                <select name="Kelurahan" id="Kelurahan" class="form-control" required>
                                                    <option disabled selected="selected">-- Pilih Kelurahan --</option>
                                                    @foreach($data['data_kelurahan']['kelurahan'] as $data_kelurahan)
                                                        <option value="{{ $data_kelurahan['nama'] }}" @if($data['umkm']->Kelurahan === $data_kelurahan['nama']) selected="selected" @endif>{{ $data_kelurahan['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">   
                                        <div class="col-sm-6">
                                            <!-- No_Telp -->
                                            <div class="form-group">
                                                <label for="">Nomor Telp  <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control only-number" maxlength="15" name="No_Telp" id="No_Telp" required placeholder="Nomor Telepon" value="{{ $data['umkm']->No_Telp }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Alamat -->
                                            <div class="form-group">
                                                <label for="">Alamat  <span style="color: #FF0000;">*</span></label>
                                                <textarea class="form-control" name="Alamat_Jalan" id="Alamat_Jalan" cols="30" rows="5" required placeholder="Alamat Jalan">{{ $data['umkm']->Alamat_Jalan }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Baris 2 -->
                                    <div class="row">
                                        <!-- Upload Foto -->
                                        <div class="col-sm-6">
                                            <div class="form-group form-floating-label">
                                                <label for="Upload Foto">Upload Foto (Format png/jpg/jpeg)</label>
                                                <input type="file" class="form-control uploads" id="Foto" name="Foto_Form" accept="image/*">
                                            </div>
                                        </div>
                                        <!-- Upload Dokumen -->
                                        <div class="col-sm-6">
                                            <div class="form-group form-floating-label">
                                                <label for="Upload Dokumen">Upload Dokumen (Format PDF)</label>
                                                <input type="file" class="form-control uploads" id="Dokumen" name="Dokumen_Form" accept="application/pdf">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="pull-right" style="margin-top: 50px;">
                                        <button class="btn btn-danger btn-sm"><strong>RESET</strong></button>
                                        <button class="btn btn-success btn-sm"><strong>SUBMIT</strong></button>
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

        $('#form-persyaratan').validate({
            errorElement: 'label',
            errorPlacement: function (error, element) {
                error.addClass('form-text text-muted');
                element.closest('.form-group').append(error);
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

    </script>

@stop 