<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>LOGIN</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    
    @include('Otentikasi.linkcss')

</head>
<body class="login">
	<div class="wrapper wrapper-login">

        <!-- Login -->
		<div class="container container-login animated fadeIn">
            <h3 class="text-center"><img src="{{ asset('assets-front/img/logo.png') }}" alt="" style="width: 150px;"></h3>
            <h1 class="text-center">LOGIN</h1>

            <form action="{{ url('/login') }}" id="loginForm" method="POST" autocomplete="off">
				{{ csrf_field() }}
				
                <div class="login-form">
					<!-- Username -->
                    <div class="form-group form-floating-label">
                        <input id="username" name="username" type="text" class="form-control input-border-bottom" required>
                        <label for="username" class="placeholder">Username</label>
					</div>
					@error('name') 
						<div class="form-line error">
							<b class="form-text text-muted">{{ $message }}</b>
						</div>
					@enderror
					@error('nomor_induk') 
						<div class="form-line error">
							<b class="form-text text-muted">{{ $message }}</b>
						</div>
					@enderror
					
					<!-- Password -->
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
                        <label for="password" class="placeholder">Password</label>
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
					</div>
					@error('password') 
						<div class="form-line error">
							<b class="error">{{ $message }}</b>
						</div>
					@enderror
					
					<!-- Remember Me Please :( -->
                    <div class="row form-sub m-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme">
                            <label class="custom-control-label" for="rememberme">Remember Me</label>
                        </div>
					</div>
					
                    <div class="form-action mb-3">
                        <button type="submit" class="btn btn-default btn-flat btn-login" style="width: 100%;">LOGIN</button>
					</div>
					
					<!-- Register -->
                    <div class="login-account">
                        <span class="msg">Belum punya akun ?</span>
                        <a href="{{ url('/register') }}" id="show-signup" class="link">Daftar</a>
                    </div>
                    <div class="text-center">
                        <a href="{{ url('/') }}" id="show-signin" class="btn btn-danger btn-link btn-login mr-3">Cancel</a>
                    </div>
                </div>

            </form>
		</div>
    </div>
    
    @include('Otentikasi.linkjs')

    <script>
        // Jquery Validator
        $("#loginForm").validate({
            errorElement: 'label',
            errorPlacement: function (error, element) {
                error.addClass('form-text text-muted');
                element.closest('.form-group').append(error);
            }
        });

        @if(session('status') == 'Password Salah')
            var content = {};
            content.title = '{{ session("status") }}';
            content.message = 'Silahkan cek ulang password yang anda miliki';
            content.icon = 'fa fa-bell';
            content.target = '_blank';

            $.notify(content,{
                type: 'danger',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                time: 3000,
                delay: 0,
            });

        @elseif(session('status') == 'User tidak aktif')
            var content = {};
            content.title = '{{ session("status") }}';
            content.message = 'User anda tidak aktif';
            content.icon = 'fa fa-bell';
            content.target = '_blank';

            $.notify(content,{
                type: 'danger',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                time: 3000,
                delay: 0,
            });
        @endif

    </script>

</body>
</html>