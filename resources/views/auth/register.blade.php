<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar | Laundry Admin</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ url('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ url('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ url('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>LAUNDRY</b></a>
            <small>LinDev - Aplikasi Laundry</small>
        </div>
        <div class="card">
            <div class="body">
                <form class="form-horizontal" id="sign_up" method="POST" action="{{ route('register') }}">
                    <div class="msg">Daftar Untuk Menjadi Pengguna</div>
                    <div class="input-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Name Lengkap" value="{{ old('nama_lengkap') }}" required>
                                @if ($errors->has('nama_lengkap'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_lengkap') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" alue="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group{{ $errors->has('nama_pengguna') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama_pengguna" placeholder="Username/Name Pengguna" value="{{ old('nama_pengguna') }}" required>
                                @if ($errors->has('nama_pengguna'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('nama_pengguna') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="input-group{{ $errors->has('sandi') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="sandi" name="sandi" minlength="6" placeholder="Password"  required>
                                @if ($errors->has('sandi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sandi') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="sandi-confirm" name="sandi_confirmation" minlength="6" placeholder="Konfirmasi Password" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">Saya setuju dengan <a href="javascript:void(0);">ketentuan pengguna</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Daftar</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ url('login') }}">Sudah mempunyai akun pengguna?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ url('plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ url('plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ url('js/admin.js') }}"></script>
    <script src="{{ url('js/pages/examples/sign-up.js') }}"></script>
</body>

</html>