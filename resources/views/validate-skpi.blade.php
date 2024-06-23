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
            <h3>SURAT KETERANGAN PENDAMPING IJAZAH (SKPI)</h3>
            <p>Nomor: {{ $data->NO_SKPI }}</p>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Informasi Mahasiswa</th>
            </tr>
            <tr>
                <td style="width: 40%">Nama</td>
                <td>{{ $data->NAMA }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>{{ $data->NIM }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>{{ $data->PRODI }}</td>
            </tr>
            <tr>
                <td>Tempat & Tanggal Lahir</td>
                <td>{{ "$data->TEMPAT_LAHIR, $data->TANGGAL_LAHIR" }}</td>
            </tr>
            <tr>
                <td>Tanggal Masuk</td>
                <td>{{ $data->TANGGAL_MASUK }}</td>
            </tr>
            <tr>
                <td>Tanggal Lulus</td>
                <td>{{ $data->TANGGAL_LULUS }}</td>
            </tr>
            <tr>
                <td>Lama Studi</td>
                <td>{{ $data->LAMA_STUDI }}</td>
            </tr>
            <tr>
                <td>Gelar</td>
                <td>{{ "Sarjana Komputer ($data->GELAR)" }}</td>
            </tr>
            <tr>
                <td>Bahasa Pengantar Kuliah</td>
                <td>Bahasa Indonesia</td>
            </tr>
        </table>
    </div>
</div>
@endsection

@include('assets.scripts')