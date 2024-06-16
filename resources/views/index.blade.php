@extends('template')

<style>
    .dt-start {display: none !important;}
</style>

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

@section('content')
<div class="card">
    @if (Helper::authUser()->ROLE == 'ADMIN')
    <div class="card-body">
        <h3>Selamat Datang</h3>
        <br>
        <h5 style="text-align: center;">Informasi Portofolio</h5>
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-ul"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-content">TOTAL YANG SUDAH MENGAJUKAN</span>
                            <span class="info-box-number">
                                {{ $data->total_mengajukan }}
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
                                {{ $data->total_menunggu }}
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
                                {{ $data->total_ditolak }}
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
                                {{ $data->total_disetujui }}
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
                                {{ $data->total_mhs }}
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
                                {{ $data->total_mhs_menunggu }}
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
                                {{ $data->total_mhs_ditolak }}
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
                                {{ $data->total_mhs_disetujui }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table id="homeTable" class="display">
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Kategori Portofolio</th>
                    <th>Nama Portofolio</th>
                    <th>Kesesuaian Portofolio</th>
                    <th>Tanggal Portofolio</th>
                    <th>No. Dokumen Portofolio</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="homeTableContent">
            </tbody>
        </table>
    </div>
    @else
    <div class="card-body">
        <table id="homeTable" class="display">
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
    @endif
</div>
@endsection

@include('assets.scripts')
<script>
    $(document).ready( function () {
        const userRole = "{{ Helper::authUser()->ROLE }}"

        if (userRole == 'ADMIN') {
            fetchData()
        } else {
            $('#homeTable').DataTable();

        }

        function fetchData() {
            $.ajax({
                type: 'GET',
                url: '/data/all/portofolio',
                success: (result) => {
                    let table = ''
    
                    result.forEach((d) => {
                        table += `
                            <tr>
                                <td>${d.NAMA_MAHASISWA}</td>
                                <td>${d.KATEGORI_PORTOFOLIO}</td>
                                <td>${d.NAMA_PORTOFOLIO}</td>
                                <td>${d.IS_SESUAI}</td>
                                <td>${d.TANGGAL_PORTOFOLIO}</td>
                                <td>${d.NO_DOKUMEN}</td>
                                <td class="fw-bolder ${d.status_text}">${d.STATUS}</td>
                            </tr>
                        `
    
                        return table
                    })
                    
                    $('#homeTableContent').html(table)
                    $('#homeTable').DataTable();
                }
            })
        }
    })
</script>