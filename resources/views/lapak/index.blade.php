@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('akun') }}" class="list-group-item list-group-item-action">
                    </i> Akun Saya
                </a>
                <a href="{{ route('lapak') }}" class="list-group-item list-group-item-action active">Lapak Penjualan</a>
                <a href="#" class="list-group-item list-group-item-action">Kelola Lapak</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card-header bg-primary text-white">Deskripsi Informasi Mengenai Produk Yang Akan Dijual</div>
            <div class="card p-4">
                <form action="{{ route('lapak.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="foto" class="form-label">Unggah Foto Produk</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-muted">Ukuran gambar maksimal 800 KB</small>
                    </div>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <select class="form-control" id="kondisi" name="kondisi" required>
                            <option value="Baru">Baru</option>
                            <option value="Bekas">Bekas</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori Produk</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Alat Masak">Alat Masak</option>
                            <option value="Kasur">Kasur</option>
                            <option value="Meja Belajar">Meja Belajar</option>
                            <option value="Lemari">Lemari</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror"
                               id="stok" name="stok" min="1" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Jual Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
