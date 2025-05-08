@extends('layouts.app')

@section('content')
@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('akun') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-user-circle"></i> Akun Saya
                </a>
                <a href="{{ route('lapak') }}" class="list-group-item list-group-item-action">Lapak Penjualan</a>
                <a href="{{ route('lapak.manage') }}" class="list-group-item list-group-item-action">Kelola Lapak</a>
            </div>
        </div>

        <!-- Profil -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">Informasi Profil</div>
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
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger">Keluar Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
