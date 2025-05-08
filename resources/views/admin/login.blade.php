@extends('layouts.admin') <!-- Pastikan Anda memiliki layout yang sesuai -->

@section('content')
<div class="container">
    <h2>Login Admin</h2>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('admin.register') }}">Daftar di sini</a></p>
</div>
@endsection
