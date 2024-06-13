@extends('template')

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

@section('content')
<div class="card">
    <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
    <div class="card-body">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="prodi">Kategori Portofolio</label>
                    <select class="form-control" name="prodi" id="">
                        <option value="NULL" selected disabled>Pilih kategori portofolio</option>
                        @foreach ($data as $key => $row)
                            <option value="{{ $row->ID }}">{{ $row->KATEGORI }}</option>
                        @endforeach
                    </select>

                    @error('prodi')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="namaMahasiswa">Nama Portofolio</label>
                    <input type="text" name="namaMhs" class="form-control" id="namaMahasiswa"
                        placeholder="Nama Portofolio" value="{{ old('namaMhs') }}">

                    @error('namaMhs')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="prodi">Kesesuaian Portofolio</label>
                    <select class="form-control" name="prodi" id="">
                        <option value="NULL" selected disabled>Pilih Kesesuaian portofolio</option>
                        <option value="linearitas">Linearitas</option>
                        <option value="non-linearitas">Non-Linearitas</option>
                    </select>

                    @error('prodi')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="tglPorto">Tanggal Portofolio</label>
                    <input type="date" name="tglPorto" class="form-control" id="tglPorto" value="{{ old('tglPorto') }}">

                    @error('tglPorto')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="tempatLahir">No. Dokumen Portofolio</label>
                    <input type="text" name="tempatLahir" class="form-control" id="tempatLahir"
                        placeholder="No. Dokumen Portofolio" value="{{ old('tempatLahir') }}">

                    @error('tempatLahir')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="fileDokumen">Upload Dokumen</label>
                    <input type="file" name="fileDokumen" class="form-control" id="fileDokumen" accept=".pdf">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th class="text-center">Kategori Portofolio</th>
                    <th>Nama Portofolio</th>
                    <th>Kesesuaian Portofolio</th>
                    <th>Tanggal Portofolio</th>
                    <th>Nomor Dokumen Portofolio</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@include('assets.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready( function () {
        new DataTable('#myTable');
    })
</script>