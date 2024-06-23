@extends('template')

@section('title', 'Daftar SKPI')

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
        const role = "{{ Helper::authUser()->ROLE }}"

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
                                <td class="fw-bolder ${(d.STATUS == 0) ? 'text-danger' : 'text-success'}">${d.STATUS_TEXT}</td>
                                <td style="display: flex; align-items: center; gap: 3px; height: 80px">
                                    <a href="#" class="btn btn-sm btn-accept-skpi bg-success ${(role == 'DEKAN' && d.STATUS == 0) ? '' : 'd-none'}" data-skpi-id=${d.ID} data-mhs-id=${d.ID_MAHASISWA}><i class="nav-icon far fa-check-square"></i></a>
                                    <a href="/print/skpi/qr/${d.ID}" target="_blank" class="btn btn-sm bg-purple ${(d.STATUS == 1) ? '' : 'd-none'}"><i class="nav-icon fa fa-print"></i></a>
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

        $(document).on('click', '.btn-accept-skpi', function () {
            const skpiID = $(this).data('skpi-id')
            const mhsID = $(this).data('mhs-id')
            const csrfToken = '{{ csrf_token() }}'

            Swal.fire({
                title: `Anda yakin ingin menyetujui draft SKPI ini?`,
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Submit",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/update/skpi/status',
                        data: {_token: csrfToken, skpiID: skpiID, mhsID: mhsID},
                        success: function(res) {
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
        })
    })
</script>