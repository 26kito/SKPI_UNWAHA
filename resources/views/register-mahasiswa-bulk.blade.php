@extends('template')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Data Mahasiswa Bulk</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="width: 1400px; margin: 0 auto;">
    <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
    <div class="card-body">
        <a href="{{ route('download-template-mahasiswa') }}" class="btn btn-warning mb-4" role="button">
            <i class="fa fa-download"></i>
            Download Template
        </a>
        <form action="{{ route('action-register-bulk') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="fileInsertMhsBulk">Unggah File Excel</label>
                    <input type="file" name="fileInsertMhsBulk" class="form-control" id="fileInsertMhsBulk"
                        accept=".xls,.xlsx">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Upload</button>
            <a href="{{ route('list-mahasiswa') }}" role="button" class="btn btn-info">Kembali</a>
        </form>
    </div>
</div>
@endsection

@include('assets.scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        let message = "{{ session('message') }}"
        let status = "<?= (session()->has('status') && session('status') === 'ok') ? 'success' : 'error' ?>"

        if (message && message != ' ') {
            Swal.fire({
                icon: status,
                title: status.toUpperCase(),
                text: message,
            });
        }
    })
</script>