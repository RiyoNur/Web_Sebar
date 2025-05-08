@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">Pembayaran Produk</div>
                <div class="card-body">
                    <h4>Produk: {{ $product->nama_produk }}</h4>
                    <p><strong>Harga: Rp {{ number_format($paymentAmount, 0, ',', '.') }}</strong></p>
                    <p>Silakan melakukan pembayaran sebesar <strong>{{ number_format($paymentAmount, 0, ',', '.') }}</strong> untuk produk Anda. Gunakan no rekening di bawah ini untuk membayar:</p>
                    <div class="text-center", style="font-size: large", style="font-weight: bold", style="color: blue">
                        {Sea Bank: 901600889761}/{Bank Bri: 060501065675501}
                    </div>
                    <p>Setelah Anda melakukan pembayaran, unggah bukti transfer Anda di bawah ini:</p>
                    <form action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="file" name="bukti_transfer" required>
                        <button type="submit">Upload Bukti</button>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('lapak') }}" class="btn btn-secondary">Kembali ke Lapak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
