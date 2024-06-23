<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SKPI UNWAHA | Halaman Masuk</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="height: 100vh!important">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <div class="logo mb-3">
          <img src="https://unwaha.ac.id/wp-content/uploads/2022/12/logo_besar.png" alt="logo-unwaha" style="width: 100px">
        </div>
        <h4>Aplikasi Surat Keterangan Pendamping Ijazah</h4>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Silahkan Login</p>

        <form action="{{ route('action-login') }}" method="post">
          @csrf

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <a href="{{ route('register') }}" role="button" class="btn btn-primary btn-block">Registrasi</a>
            </div>
            <!-- /.col -->
          </div>
          <br>
          @if ($errors->any())
          <div class="captcha">
            <img src="{{ captcha_src() }}" alt="captcha">
            <div class="mt-2"></div>
            <input 
                type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="Please Insert Captch"
                >
            @error('captcha') 
            <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
          </div>
          @endif
        </form>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let message = "{{ session('message') }}"

    if (message && message != ' ') {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
      });
    }
  </script>
</body>

</html>