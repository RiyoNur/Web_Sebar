@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="text-start">
        <h2>Dashboard Admin</h2>
        <p>Selamat datang di dashboard admin!</p>
    </div>
    <a href="{{ route('admin.payments') }}" class="btn btn-primary">Lihat Pembayaran</a>
</div>
@endsection
