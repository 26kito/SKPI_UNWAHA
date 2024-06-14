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
        <input type="text" name="nik" class="form-control" id="noKTP" placeholder="No. KTP" value="{{ old('nik') }}">

        @error('nik')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="namaIbuKandung">Nama Ibu Kandung</label>
        <input type="text" name="namaIbuKandung" class="form-control" id="namaIbuKandung" placeholder="Nama Ibu Kandung"
            value="{{ old('namaIbuKandung') }}">

        @error('namaIbuKandung')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="tempatLahir">Tempat Lahir</label>
        <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir"
            value="{{ old('tempatLahir') }}">

        @error('tempatLahir')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="tglLahir">Tanggal Lahir</label>
        <input type="date" name="tglLahir" class="form-control" id="tglLahir" value="{{ old('tglLahir') }}" min="1990-01-01">

        @error('tglLahir')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="tglMasuk">Tanggal Masuk</label>
        <input type="date" name="tglMasuk" class="form-control" id="tglMasuk" value="{{ old('tglMasuk') }}">

        @error('tglMasuk')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="tglLulus">Tanggal Lulus</label>
        <input type="date" name="tglLulus" class="form-control" id="tglLulus" value="{{ old('tglLulus') }}">

        @error('tglLulus')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="gelarMahasiswa">Gelar Mahasiswa</label>
        <input type="text" name="gelarMahasiswa" class="form-control" id="gelarMahasiswa" placeholder="Gelar Mahasiswa"
            value="{{ old('gelarMahasiswa') }}">

        @error('gelarMahasiswa')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="noIjazah">Nomor Ijazah</label>
        <input type="text" name="noIjazah" class="form-control" id="noIjazah" placeholder="Nomor Ijazah"
            value="{{ old('noIjazah') }}">

        @error('noIjazah')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">

        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">

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
        <div class="card d-none" id="cardPreviewFotoMahasiswa"
            style="background-size: cover; background-repeat: no-repeat; background-position: center center; width: 250px; height: 250px">
        </div>
    </div>
</div>
<br>
<button type="submit" class="btn btn-success">Submit</button>