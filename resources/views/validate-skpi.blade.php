@extends('template')

@section('title', "SKPI $data->NO_SKPI")

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Validasi Sukses</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-center">
            <img src="https://unwaha.ac.id/wp-content/uploads/2022/12/logo_besar.png" alt="">
            <h3 class="text-danger mt-4">UNIVERSITAS KH. A. WAHAB HASBULLAH</h3>
            <h3>DRAFT SURAT KETERANGAN PENDAMPING IJAZAH (SKPI)</h3>
            <p>Nomor: {{ $data->NO_SKPI }}</p>
        </div>
        <table class="table">
            <tr>
                <th>apalah</th>
            </tr>
            <tr>
                <td>konten</td>
                <td>konten</td>
            </tr>
            <tr>
                <td>isi konten lainnya...</td>
                <td>isi konten lainnya...</td>
            </tr>
        </table>
    </div>
</div>
@endsection

@include('assets.scripts')