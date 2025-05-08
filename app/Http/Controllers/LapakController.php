<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage; // Ubah import ini


class LapakController extends Controller
{
    /**
     * Menampilkan daftar produk yang sudah terverifikasi.
     */
    public function index()
    {
        // Mengambil produk dengan status 'verified'
        $products = Product::where('status', 'verified')->get();

        return view('lapak.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        return view('lapak.create');
    }
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id); // Mencari produk berdasarkan ID

            // Validasi input pengguna
            $request->validate([
                'nama_produk' => 'required',
                'deskripsi' => 'required',
                'kondisi' => 'required',
                'harga' => 'required|numeric',
                'alamat' => 'required',
                'nomor_telepon' => 'required',
                'stok' => 'required|integer|min:0',
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Update data produk
            $product->nama_produk = $request->nama_produk;
            $product->deskripsi = $request->deskripsi;
            $product->kondisi = $request->kondisi;
            $product->harga = $request->harga;
            $product->alamat = $request->alamat;
            $product->nomor_telepon = $request->nomor_telepon;
            $product->stok = $request->stok;

            // Update foto jika ada
            if ($request->hasFile('foto')) {
                // Hapus foto lama
                if ($product->foto) {
                    Storage::delete('public/' . $product->foto);
                }
                // Upload foto baru
                $product->foto = $request->file('foto')->store('products', 'public');
            }

            $product->save();

            return redirect()->route('lapak.manage')->with('success', 'Produk berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui produk');
        }
    }



    /**
     * Menyimpan data produk yang baru.
     */
    public function store(Request $request)
{
    try {
        // Validasi input pengguna
        $validated = $request->validate([
            'foto' => 'required|image|max:800',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'category' => 'required|string|max:255',
            'kondisi' => 'required|in:Baru,Bekas',
            'harga' => 'required|numeric|min:0',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'stok' => 'required|integer|min:1',
        ]);

        // Simpan foto produk
        $fotoPath = $request->file('foto')->store('product', 'public');

        // Simpan data produk ke database
        $product = Product::create([
            'foto' => $fotoPath,
            'nama_produk' => $request->nama_produk,
            'category' => $request->category,
            'deskripsi' => $request->deskripsi,
            'kondisi' => $request->kondisi,
            'harga' => $request->harga,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'stok' => $request->stok,
        ]);

        // Buat payment record
        Payment::create([
            'product_id' => $product->id,
            'amount' => 5000, // Biaya administrasi tetap
            'status' => 'pending'
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('lapak.payment', [
            'product' => $product->id,
            'amount' => 5000
        ]);

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

// Tambahkan method baru untuk menampilkan halaman pembayaran
public function showPayment($productId)
{
    $product = Product::findOrFail($productId);
    $paymentAmount = 5000; // Biaya administrasi tetap

    return view('lapak.payment', [
        'product' => $product,
        'paymentAmount' => $paymentAmount
    ]);
}
    /**
     * Menampilkan halaman untuk mengelola produk milik pengguna.
     */
    public function Lapakmanage()
    {
        // Ambil semua produk yang dibuat oleh pengguna yang sedang login
        $products = Product::where('user_id', auth()->user()->id)->get();

        // Kirim data produk ke view
        return view('lapak.manage', compact('products'));
    }
    public function delete($id)
{
    $product = Product::findOrFail($id); // Mencari produk berdasarkan ID
    $product->delete(); // Menghapus produk

    return redirect()->route('lapak.manage')->with('success', 'Produk berhasil dihapus.');
}
}
