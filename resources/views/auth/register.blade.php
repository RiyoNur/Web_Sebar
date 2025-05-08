@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4" style="background-color: #EAF2FF; border-radius: 10px; max-width: 600px; margin: auto;">
                <h3 class="text-center">Daftar Akun Baru</h3>
                <p class="text-center">Buat akun baru untuk mulai berbelanja...</p>
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Kata sandi" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi kata sandi" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    <div class="text-center mt-3">
                        <p>Sudah punya akun? <a href="{{ route('login.form') }}">Masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
