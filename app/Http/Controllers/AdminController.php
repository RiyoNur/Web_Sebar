<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Payment; // Pastikan ini ada di bagian atas file

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showPayments()
{
    // Hapus dd() dan ambil semua payment yang pending
    $payments = Payment::with('product')
        ->whereNotNull('bukti_transfer')  // Pastikan ada bukti transfer
        ->orderBy('created_at', 'desc')   // Urutkan terbaru
        ->get();

    // Debug log untuk memeriksa data
    Log::info('Payment data:', [
        'count' => $payments->count(),
        'data' => $payments->toArray()
    ]);

    return view('admin.payment', compact('payments'));
}


    public function verifyPayment($id)
{
    try {
        // Ambil data pembayaran
        $payment = Payment::findOrFail($id);

        // Ambil produk terkait
        $product = Product::findOrFail($payment->product_id);

        // Update status produk menjadi verified
        $product->status = 'verified';
        $product->save();
        // Notifikasi pengguna
        session()->flash('success', 'Pembayaran berhasil diverifikasi. Produk telah diunggah ke beranda.');

        return redirect()->route('admin.payments')->with('success', 'Pembayaran berhasil diverifikasi. Produk telah diunggah ke beranda.');
    } catch (\Exception $e) {
        // Log error
        Log::error('Error verifying payment: ' . $e->getMessage());

        return redirect()->route('admin.payments')->with('error', 'Terjadi kesalahan saat memverifikasi pembayaran.');
    }
}


public function notifyUser ($product)
{
    // Logika untuk notifikasi pengguna
    Log::info('User  notified about verification for product: ' . $product->id);
}
}
