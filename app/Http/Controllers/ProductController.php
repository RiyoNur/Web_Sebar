<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function storeAs(Request $request)
    {
        // Validasi input
        $request->validate([
            'foto' => 'required|image|max:800', // Pastikan file adalah gambar
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kondisi' => 'required|string',
            'harga' => 'required|numeric',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string',
            'stok',
        ]);

        // Simpan file gambar ke storage
        $path = $request->file('foto')->store('products', 'public');

        // Simpan data produk ke database
        Product::create([
            'foto' => $path, // Simpan path gambar
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'kondisi' => $request->kondisi,
            'harga' => $request->harga,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'stok',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('lapak')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function index()
    {
        // Ambil semua produk dari database
        $products = Product::all();

        // Kirim data produk ke view buyer.home
        return view('buyer.home', compact('products'));
    }

    public function show($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Kirim data produk ke view product.show
        return view('product.show', compact('product'));
    }
    public function purchase(Request $request, $id)
{
    $product = Product::findOrFail($id);

    if ($product->stok <= 0) {
        return redirect()->back()->with('error', 'Maaf, stok produk telah habis');
    }

    // Kurangi stok
    $product->stok -= 1;
    $product->save();

    // ...existing purchase logic...
}
}
