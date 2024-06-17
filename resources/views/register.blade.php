<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
      background-color: #e8ecee;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body class="hold-transition" style="height: 100vh!important">
  <div class="container" style="vertical-align: middle">
    <div class="card" style="width: 1200px">
      <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
      <div class="card-body">
        <form action="{{ route('action-register') }}" method="POST" enctype="multipart/form-data">
          @csrf

          @include('registration-input')

          <a href="{{ route('login') }}" role="button" class="btn btn-info">Kembali</a>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
  </script>
  <script>
    $(document).ready(function () {
      function previewImage(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
            // $('#previewFotoMahasiswa').attr('src', e.target.result);
            $('#cardPreviewFotoMahasiswa').css('background-image', `url(${e.target.result})`);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }
  
      $("#fotoMahasiswa").change(function() {
        if (this.files[0].size > 3145728) { // if image size greater than 3mb
          $(this).val(null)
          $('#cardPreviewFotoMahasiswa').remove()
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ukuran foto yang dipilih terlalu besar!",
          });
  
          return
        }
  
        $('#cardPreviewFotoMahasiswa').removeClass('d-none')
        previewImage(this)
      });
    })
  </script>
</body>

</html>