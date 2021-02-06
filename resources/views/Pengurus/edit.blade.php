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
                                <a href="{{ url('/pengurus') }}" class="btn btn-info btn-sm"><strong>KEMBALI</strong></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form action="{{ url('/pengurus/' . $data['pengurus']->Kode_Pengurus . '/edit') }}" id="formPengurus" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    
                                    <!-- Nama -->
                                    <div class="row">
                                        <!-- Nama Depan -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Nama Depan <span style="color: #FF0000">*</span></label>
                                                <input type="text" class="form-control only-string" required id="Nama_Depan" name="Nama_Depan" placeholder="Nama Depan" value="{{ $data['pengurus']->Nama_Depan }}">
                                            </div>
                                        </div>

                                        <!-- Nama Belakang -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Nama Belakang <span style="color: #FF0000">*</span></label>
                                                <input type="text" class="form-control only-string" required id="Nama_Belakang" name="Nama_Belakang" placeholder="Nama Belakang" value="{{ $data['pengurus']->Nama_Belakang }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- Jenis Kelamin -->
                                            <div class="form-group">
                                                <label for="">Jenis Kelamin <span style="color: #FF0000">*</span></label>
                                                <select required id="Jenis_Kelamin" name="Jenis_Kelamin" class="form-control">
                                                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                                    <option value="1" @if($data['pengurus']->Jenis_Kelamin == 1) selected="selected" @endif>Laki - laki</option>
                                                    <option value="2" @if($data['pengurus']->Jenis_Kelamin == 2) selected="selected" @endif>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Jabatan-->
                                            <div class="form-group">
                                                <label for="">Jabatan <span style="color: #FF0000">*</span></label>
                                                <select required id="Role" name="Role" class="form-control">
                                                    <option selected disabled>-- Pilih Jabatan--</option>
                                                    @foreach($data['role'] as $role)
                                                        <option value="{{ $role->id }}" @if($data['user']->role_id === $role->id) selected="selected" @endif>{{ $role->Role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-group">
                                        <label for="">Alamat <span style="color: #FF0000">*</span></label>
                                        <textarea name="Alamat" class="form-control" required id="Alamat" cols="30" rows="5" placeholder="Alamat">{{ $data['pengurus']->Alamat }}</textarea>
                                    </div>

                                    <!-- Nama -->
                                    <div class="row">
                                        <!-- Username -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Username <span style="color: #FF0000">*</span></label>
                                                <input type="text" class="form-control" required id="Username" name="Username" placeholder="Username" value="{{ $data['user']->username }}">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Email <span style="color: #FF0000">*</span></label>
                                                <input type="email" class="form-control" required id="Email" name="Email" placeholder="Email" value="{{ $data['user']->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <!-- Upload Foto -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-floating-label">
                                                <label for="Upload Foto">Upload Foto</label>
                                                <input type="file" class="form-control uploads" id="Foto" name="Foto_Avatar" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="avatar">Foto</label>
                                                <br>
                                                <div class="text-center">
                                                    <img class="product" src="{{ asset('assets-back/img/foto-user/user.png/' . $data['pengurus']->Foto ) }}" id="avatar" width="250" height="250">          
                                                </div>
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
        $(function(){
            $('.uploads').change(readURL);
        });

        $('#formPengurus').validate({
            errorElement: 'label',
            errorPlacement: function (error, element) {
                error.addClass('form-text text-muted');
                element.closest('.form-group').append(error);
            },
            // highlight: function (element, errorClass, validClass) {
            //     $('.form-group').addClass('has-error');
            // },
            // unhighlight: function (element, errorClass, validClass) {
            //     $('.form-group').removeClass('has-error');
            // }
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

        function readURL() 
        {
            var input = this;
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

@stop 