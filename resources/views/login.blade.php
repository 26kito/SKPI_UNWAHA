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
            <img src="{{ captcha_src() }}" alt="captcha" id="captchaImage">
            <a href="#" role="button" class="btn bg-success" id="refreshCaptcha">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bootstrap-reboot" viewBox="0 0 16 16">
                <path d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 1 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.8 6.8 0 0 0 1.16 8z"/>
                <path d="M6.641 11.671V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352zm0-3.75V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324z"/>
              </svg>
            </a>
            <div class="mt-2"></div>
            <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="Please Insert Captcha">
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
    const message = "{{ session('message') }}"

    if (message && message != ' ') {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
      });
    }

    $(document).on('click', '#refreshCaptcha', (e) => {
      $.ajax({
        type: 'GET',
        url: '/refresh-captcha',
        success: function(result) {
          $('#captchaImage').attr('src', result.url)
        }
      })
    })
  </script>
</body>

</html>