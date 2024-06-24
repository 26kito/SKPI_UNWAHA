@extends('template')

@section('title', 'Edit Kualifikasi')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Kualifikasi</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="width: 1400px; margin: 0 auto;">
    <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
    <div class="card-body">
        <form action="{{ route('update-kualifikasi', $data->ID) }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="prodi">Nama Prodi</label>
                    <select class="form-control" name="prodi" id="">
                        <option value="NULL" selected disabled>Pilih prodi</option>
                        <option value="sistem_informasi" {{ old('prodi')=='sistem_informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                        <option value="teknik_informatika" {{ old('prodi')=='teknik_informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                    </select>

                    @error('prodi')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="judulKualifikasi">Judul Kualifikasi</label>
                    <input type="text" name="judulKualifikasi" class="form-control" id="judulKualifikasi" placeholder="Judul Kualifikasi" value="{{ $data->JUDUL_KUALIFIKASI }}">

                    @error('judulKualifikasi')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="penjelasanKualifikasi">Penjelasan Kualifikasi</label>
                    <textarea name="penjelasanKualifikasi" id="penjelasanKualifikasi" class="form-control" rows="3" placeholder="Penjelasan Kualifikasi">{{ $data->PENJELASAN_KUALIFIKASI }}</textarea>

                    @error('penjelasanKualifikasi')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="subPenjelasan">Sub Penjelasan</label>
                    <input type="text" name="subPenjelasan" class="form-control" id="subPenjelasan" placeholder="Sub Penjelasan Kualifikasi" value="{{ $data->SUB_PENJELASAN }}">

                    @error('subPenjelasan')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</div>
@endsection

@include('assets.scripts')
<script>
    $(document).ready(function() {
        const message = "{{ session('message') }}"
        const status = "<?= (session()->has('status') && session('status') === 'ok') ? 'success' : 'error' ?>"
    
        if (message && message != ' ') {
            Swal.fire({
                icon: status,
                title: status.toUpperCase(),
                text: message,
            });
        }
    })
</script>