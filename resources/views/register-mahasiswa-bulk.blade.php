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
        <a href="" class="btn btn-warning mb-4" role="button">
            <i class="fa fa-download"></i>
            Download Template
        </a>
        <form action="{{ route('action-register') }}" method="POST" enctype="multipart/form-data">
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