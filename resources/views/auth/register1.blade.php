<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AMS - Daftar</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('data/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('data/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akunmu</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="exampleInputEmail"
                                            placeholder="Nama Lengkap" name="nama"
                                            value="{{ old('nama') }}" required autocomplete="nama">
                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" id="exampleInputEmail"
                                            placeholder="Alamat" name="alamat"
                                            value="{{ old('alamat') }}" required autocomplete="alamat">
                                        @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="exampleFirstName"
                                        placeholder="Username" name="username" value="{{ old('username') }}"  required autocomplete="name" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                                        placeholder="Email" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            @if (DB::select('select email from users') > 0)
                                                <strong>{{ 'Email sudah terdaftar' }}</strong>
                                            @else
                                                <strong>{{ 'Masukkan data yang benar' }}</strong>
                                            @endif
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Password"
                                            name="password" required
                                            autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Ulangi Password"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar
                                    Sekarang</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/">Sudah Punya Akun ? Login Disini</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('data/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('data/vendor/bootstrap/js/bootstrap.bundle.min.j') }}s"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('data/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('data/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
