@extends('template')

<style>
    .dt-start {display: none !important;}
</style>

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Portofolio</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
    <div class="card-body">
        <form action="{{ route('insert-input-portofolio') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="kategoriPorto">Kategori Portofolio</label>
                    <select class="form-control" name="kategoriPorto" id="kategoriPorto">
                        <option value="NULL" selected disabled>Pilih kategori portofolio</option>
                        @foreach ($data as $key => $row)
                            <option value="{{ $row->ID }}" {{ old('kategoriPorto') == $row->ID ? 'selected' : '' }}>{{ $row->KATEGORI }}</option>
                        @endforeach
                    </select>

                    @error('kategoriPorto')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="namaPortofolio">Nama Portofolio</label>
                    <input type="text" name="namaPorto" class="form-control" id="namaPortofolio"
                        placeholder="Nama Portofolio" value="{{ old('namaPorto') }}">

                    @error('namaPorto')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="kesesuaianPorto">Kesesuaian Portofolio</label>
                    <select class="form-control" name="kesesuaianPorto" id="kesesuaianPorto">
                        <option value="NULL" selected disabled>Pilih Kesesuaian portofolio</option>
                        <option value="linearitas">Linearitas</option>
                        <option value="non-linearitas">Non-Linearitas</option>
                    </select>

                    @error('kesesuaianPorto')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="tglPorto">Tanggal Portofolio</label>
                    <input type="date" name="tglPorto" class="form-control" id="tglPorto" value="{{ old('tglPorto') }}" onclick="'showPicker' in this && this.showPicker()"/>

                    @error('tglPorto')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="noDokumenPorto">No. Dokumen Portofolio</label>
                    <input type="text" name="noDokumenPorto" class="form-control" id="noDokumenPorto"
                        placeholder="No. Dokumen Portofolio" value="{{ old('noDokumenPorto') }}">

                    @error('noDokumenPorto')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="fileDokumen">Upload Dokumen</label>
                    <input type="file" name="fileDokumen" class="form-control" id="fileDokumen" accept=".pdf">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="portoTable" class="display">
            <thead>
                <tr>
                    <th class="text-center">Kategori Portofolio</th>
                    <th>Nama Portofolio</th>
                    <th>Kesesuaian Portofolio</th>
                    <th>Tanggal Portofolio</th>
                    <th>Nomor Dokumen Portofolio</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th style="display: none"></th>
                </tr>
            </thead>
            <tbody id="portoTableContent">
            </tbody>
        </table>
    </div>
</div>
@endsection

@include('assets.scripts')
<script>
    $(document).ready(function () {
        new DataTable('#portoTable');

        let message = "{{ session('message') }}"
        let status = "<?= (session()->has('status') && session('status') === 'ok') ? 'success' : 'error' ?>"
        let icon = "{{ asset('file.png') }}"

        if (message && message != ' ') {
            Swal.fire({
                icon: status,
                title: status.toUpperCase(),
                text: message,
            });
        }

        $.ajax({
            type: 'GET',
            url: '/data/portofolio',
            success: (result) => {
                let table = ''

                result.forEach((d) => {
                    table += `
                        <tr>
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
                            <td class="${(d.STATUS_ID != 1) ? 'd-none' : ''}" style="display: flex; align-items: center; gap: 10px; height: 80px">
                                <a href="#" class="btn bg-warning"><i class="fa fa-pen"></i></a>
                                <a href="#" class="btn bg-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `

                    return table
                })

                $('#portoTableContent').html(table)
            }
        })
    })
</script>