@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="page-inner">
            <!-- Header -->
            <div class="page-header">
                <h4 class="page-title">Profile Pengguna</h4>
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
                        <a href="#">Profile Pengguna</a>
                    </li>
                </ul>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <div class="card-title">Edit Profile</div>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/dashboard') }}" class="btn btn-info btn-sm"><strong>KEMBALI</strong></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/profile/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane in active" id="tab1">
                                        <!-- Name -->
                                        <div class="row mt-3">
                                            <!-- Username -->
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="Username" placeholder="Username" value="{{ $data->username }}">
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Email</label>
                                                    <input readonly type="email" class="form-control" name="Email" placeholder="Email" value="{{ $data->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <!-- Password -->
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Password Baru</label>
                                                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                                                </div>
                                            </div>
                                            <!-- Retype-Password -->
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Retype-Password</label>
                                                    <input type="password" class="form-control" id="Retype-Password" onkeyup="check()" name="Retype-Password" placeholder="Retype Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <!-- Upload Foto -->
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label for="">Upload Foto</label>
                                                    <input type="file" class="form-control uploads" id="Foto" name="Foto_Avatar" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right mt-3 mb-3">
                                        <button type="submit" id="btnSubmit" class="btn btn-success btn-sm"><strong>SIMPAN</strong></button>
                                        <button type="reset" class="btn btn-danger btn-sm"><strong>RESET</strong></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-header" style="background-image: url('{{ asset('assets-back/img/blogpost.jpg') }}')">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    @if($data->avatar != '')
                                        <img src="{{ asset('assets-back/img/foto-user/' . $data->avatar ) }}" id="avatar" alt="..." class="avatar-img rounded-circle">
                                    @else 
                                        <img src="{{ asset('assets-back/img/foto-user/user.png') }}" id="avatar" alt="..." class="avatar-img rounded-circle">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">{{ $data->username }}</div>
                                <div class="job">
                                    @if($data->role_id == 1)
                                        Super Admin
                                    @elseif($data->role_id == 2)
                                        Staff UMKM
                                    @elseif($data->role_id == 3)
                                        Pelaku Usaha
                                    @elseif($data->role_id == 4)
                                        Kepala Dinas
                                    @endif
                                </div>
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

        @if(session('message'))
            var content = {};
            content.title = '{{ session("message") }}';
            content.message = 'Data Profile telah diubah sesuai dengan isian form yang diberikan';
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

        function check()
        {
            if($('#Password').val() == $('#Retype-Password').val())
            {
                $('#btnSubmit').attr('disabled', false);
            }else {
                $('#btnSubmit').attr('disabled', true);
            }
        }

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