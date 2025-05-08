@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Registrasi Admin</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.register.submit') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('admin.login') }}">Login di sini</a></p>
</div>
@endsection
