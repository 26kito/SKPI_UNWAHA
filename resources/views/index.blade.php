@extends('template')

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Selamat Datang</h3>
        <br>
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