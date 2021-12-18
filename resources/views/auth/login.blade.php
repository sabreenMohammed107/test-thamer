<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thamer | Login </title>

    <!-- Google Font: Source Sans Pro -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('webassets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('webassets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('webassets/dist/css/adminlte.css')}}">
</head>

<body class="hold-transition login-page dark-mode  dir-rtl">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h4"><img src="{{ asset('webassets/dist/img/logo.png')}}" style="width:100px" /> <b>ثامر بن ساري العنزي</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">تسجيل دخول إلي ثامر بن ساري العنزي</p>


                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                            {{-- <input id="email" type="text" placeholder="البريد الالكتروني" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
                            <input id="n_id" type="text" placeholder="رقم الهوية" class="form-control @error('n_id') is-invalid @enderror" name="n_id" value="{{ old('n_id') }}" required autocomplete="n_id" autofocus>

                            @error('n_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                    </div>
                            <div class="input-group mb-3">
                            <input id="password" placeholder="كلمة المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>



                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                تسجيل دخول
                            </button>


                        </div>
                    </div>
                </form>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('webassets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('webassets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('webassets/dist/js/adminlte.min.js')}}"></script>
</body>

</html>
