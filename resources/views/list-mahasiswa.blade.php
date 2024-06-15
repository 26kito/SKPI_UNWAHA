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
            <a class="btn btn-info" href="{{ route('add-mahasiswa') }}" role="button">
                <i class="fa fa-plus"></i>
                Tambah Data Mahasiswa</a>
            <a class="btn btn-success" href="{{ route('add-mahasiswa-bulk') }}" role="button">
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
                    <th>Status</th>
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

        fetchData()

        $(document).on('click', '.update-status', function() {
            const nim = $(this).data('nim')
            const status = $(this).data('status')
            const message = $(this).data('status') == 1 ? 'Menon-aktifkan' : 'Mengaktifkan'
            const csrfToken = '{{ csrf_token() }}';

            if (confirm(`Anda yakin ingin ${message} mahasiswa ini?`)) {
                $.ajax({
                    type: 'POST',
                    url: '/update/mahasiswa/status',
                    data: {_token: csrfToken, nim: nim, status: status},
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: res.status.toUpperCase(),
                            text: res.message,
                        });

                        fetchData()
                    }
                })
            }
        })

        function fetchData() {
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
                                <td>${(d.TANGGAL_LULUS) ? d.TANGGAL_LULUS : '-'}</td>
                                <td>${(d.NO_IJAZAH) ? d.NO_IJAZAH : '-'}</td>
                                <td>${d.GELAR}</td>
                                <td>
                                    <a href="#" class="btn btn-sm ${(d.STATUS == '1') ? 'bg-success' : 'bg-danger'}">
                                        ${(d.STATUS == '1') ? 'AKTIF' : 'NON-AKTIF'}
                                    </a>
                                </td>
                                <td style="display: flex; align-items: center; gap: 5px; height: 80px">
                                    <a href="#" class="update-status btn btn-sm ${(d.STATUS == '1') ? 'bg-success' : 'bg-danger'}" data-nim="${d.NIM}" data-status="${d.STATUS}">
                                        <i class="fa ${(d.STATUS == '1') ? 'fa-check' : 'fa-times'}"></i>
                                    </a>
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
        }
    })
</script>