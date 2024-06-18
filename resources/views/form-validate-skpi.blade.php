@extends('template')

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
<div class="card" style="width: 1400px; margin: 0 auto;">
    <h5 class="card-header">Masukkan Encryption Code yang anda scan dari QR Code!</h5>
    <div class="card-body">
        <form action="{{ route('action-validate-skpi') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="encryptionCode">Encryption Code</label>
                    <textarea name="encryptionCode" id="encryptionCode" class="form-control" rows="2" placeholder="Encryption Code"></textarea>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection

@include('assets.scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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