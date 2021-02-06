<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Sistem Pendukung Keputusan Bantuan | Kabupaten Bandung Barat</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    
    @include('Otentikasi.linkcss')

</head>
<body class="login">
	<div class="wrapper wrapper-login">

        <!-- Register -->
		<div class="container container-login animated fadeIn" style="width: 100%;">
            <h3 class="pull-left">
                <img src="{{ asset('assets-back/img/logo.png') }}" alt="" style="width: 120px;">
                <span style="margin-left: 40px; font-size: 25px;" class="font-proxima"><strong>Pendaftaran UMKM</strong></span>
            </h3>
            
            <form action="{{ url('/register') }}" id="registerForm" method="POST" autocomplete="off" style="margin-top: 150px;">
                {{ csrf_field() }}
                <div class="login-form">
                    <div class="row">
                        <!-- Form 1 -->
                        <div class="col-sm-6">
                            <!-- Nama Usaha -->
                            <div class="form-group">
                                <label for="">Nama Usaha  <span style="color: #FF0000;">*</span></label>
                                <input type="text" class="form-control" name="Nama_Usaha" id="Nama_Usaha" required placeholder="Nama Usaha">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- Nama Pemilik Usaha -->
                            <div class="form-group">
                                <label for="">Nama Pemilik Usaha  <span style="color: #FF0000;">*</span></label>
                                <input type="text" class="form-control only-string" name="Nama_Pemilik_Usaha" id="Nama_Pemilik_Usaha" required placeholder="Nama Pemilik Usaha">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Username -->
                            <div class="form-group">
                                <label for="">Username  <span style="color: #FF0000;">*</span></label>
                                <input type="text" class="form-control" name="Username" id="Username" required placeholder="Username">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Email -->
                            <div class="form-group">
                                <label for="">Email  <span style="color: #FF0000;">*</span></label>
                                <input type="email" class="form-control" name="Email" id="Email" required placeholder="Email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Password -->
                            <div class="form-group">
                                <label for="">Password  <span style="color: #FF0000;">*</span></label>
                                <input type="password" class="form-control" name="Password" id="Password" required placeholder="Password">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Password -->
                            <div class="form-group">
                                <label for="">Retype Password  <span style="color: #FF0000;">*</span></label>
                                <input type="password" onkeyup="check()" class="form-control" name="Retype_Password" id="Retype_Password" required placeholder="Retype Password">
                            </div>
                        </div>
                    </div>

                    <div class="form-action">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <a href="{{ url('/') }}" id="show-signin" class="btn btn-danger btn-link btn-login mr-3">Cancel</a>
                                    <button type="submit" id="btnSubmit" class="btn btn-default btn-login"><strong>Daftar</strong></button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
		</div>
    </div>
    
    @include('Otentikasi.linkjs')

    <script>
        $(function(){

            // Datepicker
            $('.datepicker').datetimepicker({
                format: 'MM/DD/YYYY',
                useCurrent: false
            });

            // Jquery Validator
            $("#registerForm").validate({
                errorElement: 'label',
                errorPlacement: function (error, element) {
                    error.addClass('form-text text-muted');
                    element.closest('.form-group').append(error);
                }
            });

        });

        
        function setuju()
        {
            if($('#agree').is(':checked'))
                $('#btnSubmit').attr('disabled', false);
            else
                $('#btnSubmit').attr('disabled', true);
        }

        function check()
        {
            if($('#Password').val() == $('#Retype_Password').val())
            {
                $('#btnSubmit').attr('disabled', false);
            }else {
                $('#btnSubmit').attr('disabled', true);
            }
        }


    </script>

</body>
</html>