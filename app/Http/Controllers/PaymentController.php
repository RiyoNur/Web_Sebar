<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Verifikasi pembayaran berdasarkan jumlah dan ID produk.
     */
    public function verify($amount, $product_id)
    {
        // Temukan produk berdasarkan ID, atau gagal jika tidak ditemukan
        $product = Product::findOrFail($product_id);

        // Verifikasi jumlah pembayaran
        if ($amount == 5000) {
            // Ubah status produk menjadi verified
            $product->update(['status' => 'verified']);

            // Log keberhasilan
            Log::info('Pembayaran berhasil diverifikasi untuk produk ID: ' . $product->id);

            return redirect()->route('lapak')->with('success', 'Pembayaran berhasil! Produk Anda telah diverifikasi.');
        }

        // Log jika jumlah tidak sesuai
        Log::warning('Pembayaran gagal: jumlah tidak sesuai untuk produk ID: ' . $product->id);

        return redirect()->route('lapak')->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }

    /**
     * Unggah bukti transfer dan perbarui status produk.
     */
    public function uploadBuktiTransfer(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if (!$request->hasFile('bukti_transfer')) {
        return back()->with('error', 'File tidak ditemukan di request.');
    }

    $file = $request->file('bukti_transfer');
    $filename = time() . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('bukti_transfers', $filename, 'public');

    // Buat atau ambil data payment berdasarkan product_id
    $payment = Payment::firstOrCreate(
        ['product_id' => $request->product_id],
        ['status' => 'pending']
    );

    // Update bukti transfer dan status payment
    $payment->update([
        'bukti_transfer' => $path,
        'status' => 'review'
    ]);

    // Update status produk juga
    $payment->product->update([
        'status' => 'review'
    ]);

    return back()->with('success', 'Bukti transfer berhasil diunggah.');

}


    /**
     * Beri tahu admin tentang pembayaran baru.
     */
    public function notifyAdmin($product)
    {
        // Log notifikasi ke admin
        Log::info('Admin diberitahu tentang pembayaran baru untuk produk ID: ' . $product->id);

        // Anda dapat mengganti log ini dengan logika notifikasi seperti email atau database entry
    }
}
