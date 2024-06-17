@extends('template')

<style>
    .dt-start {display: none !important;}
</style>

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Portofolio</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table id="listPortofolio" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kategori Portofolio</th>
                    <th>Nama Portofolio</th>
                    <th>Kesesuaian</th>
                    <th>Tanggal Portofolio</th>
                    <th>No. Dokumen Portofolio</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="listPortofolioContent">
            </tbody>
        </table>
    </div>
</div>
@endsection

@include('assets.scripts')
<script>
    $(document).ready(function () {
        fetchData()

        let icon = "{{ asset('file.png') }}"

        function fetchData() {
            $.ajax({
                type: 'GET',
                url: '/data/all/portofolio',
                success: (result) => {
                    let table = ''
                    let counter = 0
    
                    result.forEach((d) => {
                        counter++

                        table += `
                            <tr>
                                <td>${counter}</td>
                                <td>${d.NAMA_MAHASISWA}</td>
                                <td>${d.KATEGORI_PORTOFOLIO}</td>
                                <td>${d.NAMA_PORTOFOLIO}</td>
                                <td>${d.IS_SESUAI}</td>
                                <td>${d.TANGGAL_PORTOFOLIO}</td>
                                <td>${d.NO_DOKUMEN}</td>
                                <td>
                                    <a href="/download/portofolio/${d.NAMA_FILE}" onclick="return confirm('Download file ini?')">
                                        <img src="${icon}" style="max-width: 30px">
                                    </a>
                                </td>
                                <td class="fw-bolder ${d.status_text}">${d.STATUS}</td>
                                <td style="display: flex; align-items: center; gap: 3px; height: 80px">
                                    <a href="#" class="btn btn-sm btn-action-porto ${(d.STATUS_ID == 1) ? 'bg-success' : ((d.STATUS_ID == 2) ? 'bg-info' : 'bg-danger')}" data-portofolio-id=${d.ID_PORTOFOLIO} data-action="accept">
                                        <i class="fa ${(d.STATUS_ID == 1) ? 'fa-check' : ((d.STATUS_ID == 2) ? 'fa-hourglass-half' : 'fa-times-circle')}"></i>
                                    </a>
                                    <a href="#" class="btn btn-action-porto btn-sm bg-danger" data-portofolio-id=${d.ID_PORTOFOLIO} data-action="decline"><i class="fa fa-times-circle"></i></a>
                                    <a href="#" class="btn btn-sm bg-warning"><i class="fa fa-pen"></i></a>
                                </td>
                            </tr>
                        `
    
                        return table
                    })
                    
                    $('#listPortofolioContent').html(table)
                    $('#listPortofolio').DataTable();
                }
            })
        }

        $(document).on('click', '.btn-action-porto', function () {
            const portofolioID = $(this).data('portofolio-id')
            const status = ($(this).data('action') == 'accept') ? 2 : 3
            const csrfToken = '{{ csrf_token() }}'

            $.ajax({
                type: 'POST',
                url: '/update/portofolio/status',
                data: {_token: csrfToken, portofolioID: portofolioID, status: status},
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: res.status.toUpperCase(),
                        text: res.message,
                    });

                    fetchData()
                }
            })
        })
    })
</script>