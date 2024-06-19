@extends('template')

@section('title', 'Tambah Data Mahasiswa')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Data Mahasiswa</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="width: 1400px; margin: 0 auto;">
    <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
    <div class="card-body">
        <form action="{{ route('action-register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('registration-input')
        </form>
    </div>
</div>
@endsection

@include('assets.scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        function previewImage(input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#cardPreviewFotoMahasiswa').css('background-image', `url(${e.target.result})`);
            }
            
            reader.readAsDataURL(input.files[0]);
            }
        }
  
        $("#fotoMahasiswa").change(function() {
            if (this.files[0].size > 3145728) { // if image size greater than 3mb
                $(this).val(null)
                $('#cardPreviewFotoMahasiswa').remove()
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Ukuran foto yang dipilih terlalu besar!",
                });
  
                return
            }
  
            $('#cardPreviewFotoMahasiswa').removeClass('d-none')
            previewImage(this)
        });

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