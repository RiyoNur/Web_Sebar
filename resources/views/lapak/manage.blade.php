@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('akun') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-user-circle"></i> Akun Saya
                </a>
                <a href="{{ route('lapak') }}" class="list-group-item list-group-item-action">Lapak Penjualan</a>
                <a href="{{ route('lapak.manage') }}" class="list-group-item list-group-item-action active">Kelola Lapak</a>
            </div>
        </div>

        <!-- Kelola Lapak -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">Kelola Produk Anda</div>
                <div class="card-body">
                    @if ($products->count() > 0)
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <!-- Tampilkan gambar produk -->
                                        <img src="{{ asset('storage/' . $product->foto) }}"
                                             class="card-img-top"
                                             alt="{{ $product->nama_produk }}"
                                             style="height: 200px; object-fit: cover;">
                                             <div class="card-body">
                                                <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                                <p class="card-text">
                                                    <strong>Deskripsi:</strong> {{ $product->deskripsi }}<br>
                                                    <strong>Kondisi:</strong> {{ $product->kondisi }}<br>
                                                    <strong>Harga:</strong> Rp{{ number_format($product->harga, 0, ',', '.') }}<br>
                                                    <strong>Alamat:</strong> {{ $product->alamat }}<br>
                                                    <strong>Nomor Telepon:</strong> {{ $product->nomor_telepon }}<br>
                                                    <strong>Stok:</strong> {{ $product->stok }}
                                                </p>
                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                                    Edit Produk
                                                </button>
                                                <!-- Form Delete -->
                                                <form action="{{ route('lapak.delete', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus Produk</button>
                                                </form>
                                            </div>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('lapak.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="foto" class="form-label">Foto Produk</label>
                                                                    <input type="file" class="form-control" id="foto" name="foto">
                                                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                                                           value="{{ $product->nama_produk }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                                                              required>{{ $product->deskripsi }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="kondisi" class="form-label">Kondisi</label>
                                                                    <select class="form-control" id="kondisi" name="kondisi" required>
                                                                        <option value="Baru" {{ $product->kondisi == 'Baru' ? 'selected' : '' }}>Baru</option>
                                                                        <option value="Bekas" {{ $product->kondisi == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="harga" class="form-label">Harga</label>
                                                                    <input type="number" class="form-control" id="harga" name="harga"
                                                                           value="{{ $product->harga }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="alamat" class="form-label">Alamat</label>
                                                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                                                           value="{{ $product->alamat }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                                                           value="{{ $product->nomor_telepon }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="stok" class="form-label">Stok</label>
                                                                    <input type="number" class="form-control" id="stok" name="stok"
                                                                           value="{{ $product->stok }}" min="0" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada produk yang diunggah.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection\
