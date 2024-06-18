<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  @include('assets.stylesheet')
</head>

<body>
  <div class="card card-outline card-primary" style="width: 1000px; margin: 10% auto;">
    <div class="card-body">
      <div class="text-center">
        <img src="data:image/png;base64,{{ $qr }}" alt="">
      </div>
      <h3 class="text-center text-danger">Scan QR code diatas untuk mendapatkan kode validasi SKPI</h3>
    </div>
  </div>
</body>

</html>