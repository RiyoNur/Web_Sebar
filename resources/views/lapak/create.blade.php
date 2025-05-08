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
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" required>
    </div>
    <div class="mb-3">
        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
    </div>

    <button type="submit" class="btn btn-primary">Jual Sekarang</button>
</form>
