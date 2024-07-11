@extends('template')

@section('title', "Validasi SKPI")

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Validasi</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Masukkan Encryption Code yang anda scan dari QR Code!</h5>
                <div class="card-body">
                    <form action="{{ route('action-validate-skpi') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="encryptionCode">Encryption Code</label>
                            <textarea name="encryptionCode" id="encryptionCode" class="form-control" rows="2"
                                placeholder="Encryption Code"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('assets.scripts')
<script>
    $(document).ready(function() {
        let message = "{{ session('message') }}"
        let status = "<?= (session()->has('status') && session('status') === 'ok') ? 'success' : 'error' ?>"

        if (message && message != ' ') {
            Swal.fire({
                icon: status,
                title: status.toUpperCase(),
                text: message,
            });
        }
    })
</script>