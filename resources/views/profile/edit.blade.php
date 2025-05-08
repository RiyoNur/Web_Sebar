@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('akun') }}" class="list-group-item list-group-item-action active">ediit</a>
                <a href="{{ route('lapak') }}" class="list-group-item list-group-item-action">Lapak Penjualan</a>
                <a href="#" class="list-group-item list-group-item-action">Kelola Lapak</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h4>Informasi Profil</h4>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('logout') }}" class="btn btn-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Keluar Akun
                </a>
            </form>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
