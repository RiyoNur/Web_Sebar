@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Pembayaran Menunggu Verifikasi</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Status</th>
                <th>Bukti Transfer</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($payments->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Tidak ada pembayaran yang menunggu verifikasi.</td>
                </tr>
            @else
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->product->nama_produk }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>
                            @if ($payment->bukti_transfer)
                                <a href="{{ Storage::url($payment->bukti_transfer) }}" target="_blank">
                                    <img src="{{ Storage::url($payment->bukti_transfer) }}"
                                         alt="Bukti Transfer"
                                         style="width: 100px; height: auto;">
                                </a>
                            @else
                                <span class="text-danger">Tidak ada bukti transfer</span>
                            @endif
                        </td>
                        <td>
                            @if ($payment->product->status == 'pending')
                                <form action="{{ route('admin.verifyPayment', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Verifikasi</button>
                                </form>
                            @else
                                <button class="btn btn-danger" disabled>&#10006;</button>
                            @endif
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
