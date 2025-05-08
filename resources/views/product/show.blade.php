@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">{{ $product->nama_produk }}</div>
        <div class="card-body">
            <img src="{{ asset('storage/' . $product->foto) }}" class="img-fluid" alt="{{ $product->nama_produk }}">

            @php
                $average = $product->ratings->avg('rating');
            @endphp
            @if ($average)
                <p class="mt-2"><strong>Rating Rata-Rata:</strong> {{ number_format($average, 1) }} / 5</p>
            @endif

            <h5 class="mt-3">Deskripsi:</h5>
            <p>{{ $product->deskripsi }}</p>
            <p><strong>Kondisi:</strong> {{ $product->kondisi }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            <p><strong>Alamat:</strong> {{ $product->alamat }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $product->nomor_telepon }}</p>
            <p><strong>Stok:</strong> {{ $product->stok }}</p>
            <a href="https://wa.me/{{ $product->nomor_telepon }}" class="btn btn-success" target="_blank">Beli via WhatsApp</a>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            {{-- Form rating --}}
            <hr>
            <h5 class="mt-4">Beri Rating Produk Ini:</h5>
            <form action="{{ route('ratings.store', $product->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="rating">Rating (1–5):</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="">Pilih rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} Bintang</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="comment">Komentar (opsional):</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Kirim Rating</button>
            </form>

            {{-- Daftar komentar/rating --}}
            <hr>
            <h5 class="mt-4">Ulasan Pembeli:</h5>
            @if ($product->ratings->isEmpty())
                <p>Belum ada ulasan.</p>
            @else
                @foreach ($product->ratings as $rating)
                    <div class="border rounded p-3 mb-3">
                        <p><strong>Rating:</strong> {{ $rating->rating }} / 5</p>
                        @if ($rating->comment)
                            <p><strong>Komentar:</strong> {{ $rating->comment }}</p>
                        @endif
                        <small class="text-muted">Ditulis pada {{ $rating->created_at->format('d M Y') }}</small>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
