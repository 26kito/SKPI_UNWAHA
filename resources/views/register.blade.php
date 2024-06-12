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
      height: 100vh;
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

<body style="background-color: #e8ecee">
  <div class="container" style="vertical-align: middle">
    <div class="card" style="width: 1200px">
      <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
      <div class="card-body">
        <form action="{{ route('action-register') }}" method="POST">
          @csrf

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Nama Prodi</label>
              <select class="form-control" name="" id="">
                <option value="" selected disabled>Pilih prodi</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="namaMahasiswa">Nama Mahasiswa</label>
              <input type="text" name="namaMhs" class="form-control" id="namaMahasiswa" placeholder="Nama Mahasiswa">
            </div>
            <div class="form-group col-md-4">
              <label for="nim">NIM</label>
              <input type="text" name="nim" class="form-control" id="nim" placeholder="NIM">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="noKTP">No. KTP</label>
              <input type="text" name="nik" class="form-control" id="noKTP" placeholder="No. KTP">
            </div>
            <div class="form-group col-md-6">
              <label for="namaIbuKandung">Nama Ibu Kandung</label>
              <input type="text" class="form-control" id="namaIbuKandung" placeholder="Nama Ibu Kandung">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="tempatLahir">Tempat Lahir</label>
              <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir">
            </div>
            <div class="form-group col-md-4">
              <label for="tglLahir">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tglLahir">
            </div>
            <div class="form-group col-md-4">
              <label for="tglMasuk">Tanggal Masuk</label>
              <input type="date" class="form-control" id="tglMasuk">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="gelarMahasiswa">Gelar Mahasiswa</label>
              <input type="text" class="form-control" id="gelarMahasiswa" placeholder="Gelar Mahasiswa">
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group col-md-4">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="fotoMahasiswa">Foto Mahasiswa</label>
              <input type="file" name="fotoMahasiswa" class="form-control" id="fotoMahasiswa" accept="image/*">
              <img src="#" id="previewFotoMahasiswa" class="d-none">
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="{{ url()->previous() }}" role="button" class="btn btn-info">Kembali</a>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
  </script>
  <script>
    function previewImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
          $('#previewFotoMahasiswa').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#fotoMahasiswa").change(function() {
      $('#previewFotoMahasiswa').removeClass('d-none')
      previewImage(this)
    });
  </script>
</body>

</html>