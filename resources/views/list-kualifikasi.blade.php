@extends('template')

<style>
    .dt-start {display: none !important;}
</style>

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Kualifikasi</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="add-kualifikasi mb-5">
            <a class="btn btn-info" href="{{ route('insert-kualifikasi') }}" role="button">
                <i class="fa fa-plus"></i>
                Tambah Data Kualifikasi</a>
        </div>
        <table id="listKualifikasi" class="display">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th>Nama Program Studi</th>
                    <th>Judul Kualifikasi</th>
                    <th>Penjelasan Kualifikasi</th>
                    <th>Sub Penjelasan Kualifikasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="listKualifikasiContent">
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
                url: '/get-data/kualifikasi',
                success: (result) => {
                    let table = ''
                    let counter = 0
                    
                    result.forEach((d) => {
                        counter++

                        table += `
                            <tr>
                                <td>${counter}</td>
                                <td>${d.PRODI}</td>
                                <td>${d.JUDUL_KUALIFIKASI}</td>
                                <td>${d.PENJELASAN_KUALIFIKASI}</td>
                                <td>${(d.SUB_PENJELASAN) ? d.SUB_PENJELASAN : ''}</td>
                                <td style="display: flex; align-items: center; gap: 5px; height: 80px">
                                    <a href="#" class="btn btn-sm bg-warning"><i class="fa fa-pen"></i></a>
                                    <a href="#" class="btn btn-sm bg-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        `

                        return table
                    })

                    $('#listKualifikasiContent').html(table)
                    $('#listKualifikasi').DataTable({'pageLength': 15});
                }
            })
        }
    })
</script>