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
        <form action="{{ route('action-register') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="prodi">Nama Prodi</label>
              <select class="form-control" name="prodi" id="">
                <option value="NULL" selected disabled>Pilih prodi</option>
                <option value="sistem_informasi" {{ old('prodi')=='sistem_informasi' ? 'selected' : '' }}>Sistem
                  Informasi</option>
                <option value="teknik_informatika" {{ old('prodi')=='teknik_informatika' ? 'selected' : '' }}>Teknik
                  Informatika</option>
              </select>

              @error('prodi')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-4">
              <label for="namaMahasiswa">Nama Mahasiswa</label>
              <input type="text" name="namaMhs" class="form-control" id="namaMahasiswa" placeholder="Nama Mahasiswa"
                value="{{ old('namaMhs') }}">

              @error('namaMhs')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-4">
              <label for="nim">NIM</label>
              <input type="text" name="nim" class="form-control" id="nim" placeholder="NIM" value="{{ old('nim') }}">

              @error('nim')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="noKTP">No. KTP</label>
              <input type="text" name="nik" class="form-control" id="noKTP" placeholder="No. KTP"
                value="{{ old('nik') }}">

              @error('nik')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="namaIbuKandung">Nama Ibu Kandung</label>
              <input type="text" name="namaIbuKandung" class="form-control" id="namaIbuKandung"
                placeholder="Nama Ibu Kandung" value="{{ old('namaIbuKandung') }}">

              @error('namaIbuKandung')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="tempatLahir">Tempat Lahir</label>
              <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir"
                value="{{ old('tempatLahir') }}">

              @error('tempatLahir')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-4">
              <label for="tglLahir">Tanggal Lahir</label>
              <input type="date" name="tglLahir" class="form-control" id="tglLahir" value="{{ old('tglLahir') }}">

              @error('tglLahir')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-4">
              <label for="tglMasuk">Tanggal Masuk</label>
              <input type="date" name="tglMasuk" class="form-control" id="tglMasuk" value="{{ old('tglMasuk') }}">

              @error('tglMasuk')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="gelarMahasiswa">Gelar Mahasiswa</label>
              <input type="text" name="gelarMahasiswa" class="form-control" id="gelarMahasiswa"
                placeholder="Gelar Mahasiswa" value="{{ old('gelarMahasiswa') }}">

              @error('gelarMahasiswa')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                value="{{ old('email') }}">

              @error('email')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-4">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                value="{{ old('password') }}">

              @error('password')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="fotoMahasiswa">Foto Mahasiswa</label>
              <input type="file" name="fotoMahasiswa" class="form-control" id="fotoMahasiswa" accept="image/*">
              <br>
              {{-- <div class="card d-none" id="cardPreviewFotoMahasiswa" style="max-width: 300px; max-height: 300px">
                <img src="#" id="previewFotoMahasiswa" style="object-fit: cover; width: 100%; height: 100%">
              </div> --}}
              <div class="card d-none" id="cardPreviewFotoMahasiswa" style="background-size: cover; background-repeat: no-repeat; background-position: center center; width: 250px; height: 250px">
              </div>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-success">Submit</button>
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