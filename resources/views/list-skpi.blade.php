@extends('template')

<style>
    .dt-start {display: none !important;}
</style>

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data SKPI</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table id="listSkpi" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor SKPI</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="listSkpiContent">
            </tbody>
        </table>
    </div>
</div>
@endsection

@include('assets.scripts')
<script>
    $(document).ready(function () {
        fetchData()

        function fetchData() {
            $.ajax({
                type: 'GET',
                url: '/data/all/skpi',
                success: (result) => {
                    let table = ''
                    let counter = 0
    
                    result.forEach((d) => {
                        counter++

                        table += `
                            <tr>
                                <td>${counter}</td>
                                <td>${d.NO_SKPI}</td>
                                <td>${d.NAMA_MAHASISWA}</td>
                                <td>${d.TANGGAL_SKPI}</td>
                                <td>${d.STATUS}</td>
                                <td style="display: flex; align-items: center; gap: 3px; height: 80px">
                                    <a href="#" class="btn btn-sm btn-action-porto bg-warning" data-portofolio-id=${d.ID_PORTOFOLIO} data-action="accept">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="#" class="btn btn-action-porto btn-sm bg-danger" data-portofolio-id=${d.ID_PORTOFOLIO} data-action="decline"><i class="fa fa-trash"></i></a>
                                    <a href="/print/skpi/qr/${d.ID}" target="_blank" class="btn btn-sm bg-warning"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                        `
    
                        return table
                    })
                    
                    $('#listSkpiContent').html(table)
                    $('#listSkpi').DataTable();
                }
            })
        }
    })
</script>