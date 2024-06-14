@extends('template')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Home</h1>
            </div>
        </div>
    </div>
</div>
@endsection

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Selamat Datang</h3>
        <br>
        <h5 style="text-align: center;">Informasi Portofolio</h5>
        <section class="content">

        </section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-ul"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">TOTAL YANG SUDAH MENGAJUKAN</span>
                            <span class="info-box-number">
                                5
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hourglass-start"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">MENUNGGU PERSETUJUAN</span>
                            <span class="info-box-number">
                                2
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">PENGAJUAN YANG DITOLAK</span>
                            <span class="info-box-number">
                                0
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">PENGAJUAN YANG DISETUJUI</span>
                            <span class="info-box-number">
                                3
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">TOTAL MAHASISWA</span>
                            <span class="info-box-number">
                                2
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">JUMLAH MAHASISWA</span>
                            <span class="info-box-number">
                                2
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">JUMLAH MAHASISWA</span>
                            <span class="info-box-number">
                                0
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">JUMLAH MAHASISWA</span>
                            <span class="info-box-number">
                                0
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th class="text-center" style="width: 30%">Tanggal</th>
                    <th style="width: 60%">Info</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start" style="height: 100px">{{ date('Y-m-d H:m:s') }}</td>
                    <td>Silahkan klik link berikut: (link belum tersedia)</td>
                </tr>
                <tr>
                    <td class="text-start" style="height: 100px">{{ date('Y-m-d H:m:s') }}</td>
                    <td>SKPI merupakan surat pendamping yang tertulis dalam bentuk deskripsi capaian pembelajaran untuk
                        menjelaskan kualifikasi yang dimiliki seorang lulusan, selain ijazah dan transkrip akademik.
                    </td>
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