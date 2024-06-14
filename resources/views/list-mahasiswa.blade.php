@extends('template')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Mahasiswa</h1>
            </div>
        </div>
    </div>
</div>
@endsection

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

@section('content')
<div class="card">
    <div class="card-body">
        <div class="add-mahasiswa mb-5">
            <a class="btn btn-info" href="#" role="button">
                <i class="fa fa-plus"></i>
                Tambah Data Mahasiswa</a>
            <a class="btn btn-success" href="#" role="button">
                <i class="fa fa-plus"></i>
                Tambah Data Mahasiswa Bulk</a>
        </div>
        <table id="listMahasiswa" class="display">
            <thead>
                <tr>
                    <th class="text-center">Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Nama Prodi</th>
                    <th>Tempat & Tanggal Lahir</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Lulus</th>
                    <th>No. Ijazah</th>
                    <th>Gelar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="listMahasiswaContent">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        new DataTable('#listMahasiswa');

        $.ajax({
            type: 'GET',
            url: '/get-data/mahasiswa',
            success: (result) => {
                let table = ''

                result.forEach((d) => {
                    table += `
                        <tr>
                            <td>${d.NAMA}</td>
                            <td>${d.NIM}</td>
                            <td>${d.PRODI}</td>
                            <td>${d.TempatTglLahir}</td>
                            <td>${d.TANGGAL_MASUK}</td>
                            <td>2024-06-06</td>
                            <td>No Ijazah</td>
                            <td>${d.GELAR}</td>
                            <td style="display: flex; align-items: center; gap: 5px; height: 80px">
                                <a href="#" class="btn btn-sm bg-success"><i class="fa fa-check"></i></a>
                                <a href="#" class="btn btn-sm bg-warning"><i class="fa fa-pen"></i></a>
                                <a href="#" class="btn btn-sm bg-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `

                    return table
                })

                $('#listMahasiswaContent').html(table)
            }
        })
    })
</script>