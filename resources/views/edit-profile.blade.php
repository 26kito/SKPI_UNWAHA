@extends('template')

@section('title', "Ubah Password")

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ubah Password</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <h5 class="card-header">Silahkan melengkapi form berikut!</h5>
    <div class="card-body">
        <form action="{{ route('update-profile') }}" method="POST">
            @csrf

            <div class="form-group col-md-3">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ $user->USERNAME }}"
                    readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="oldPass">Password Lama</label>
                <input type="password" name="oldPass" class="form-control" id="oldPass" value="{{ old('oldPass') }}" placeholder="Password lama"
                    required>

                @error('oldPass')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="newPass">Password Baru</label>
                <input type="password" name="newPass" class="form-control" id="newPass" value="{{ old('newPass') }}" placeholder="Password baru"
                    required>

                @error('newPass')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="newPassConfirm">Konfirmasi Password Baru</label>
                <input type="password" name="newPassConfirm" class="form-control" id="newPassConfirm"
                    value="{{ old('newPassConfirm') }}" placeholder="Masukkan password baru sekali lagi" required>

                @error('newPassConfirm')
                <div class="text-danger">{{ $message }}</div>
                @enderror
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
    $(document).ready(() => {
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