@extends('layouts.app_buyer')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Profil Pembeli</div>
        <!-- Profil -->
                <div class="card-body">
                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>

                        <!-- Kata Sandi -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <!-- Konfirmasi Kata Sandi -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                    <!-- Tombol Logout -->
                    <button type="button" class="btn btn-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar Akun
                    </button>
                    <form id="logout-form" action="{{ route('buyer.logout') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ route('buyer.login.form') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
