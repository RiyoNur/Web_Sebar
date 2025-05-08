<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BuyerController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'verified')->get();
        return view('buyer.home', compact('products'));
    }

       public function profile()
    {
        return view('buyer.profile');
    }
    public function search(Request $request)
{
    $search = $request->search;

    $products = Product::query()
        ->where('status', 'verified')
        ->where(function($query) use ($search) {
            $query->where('nama_produk', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
        })
        ->get();

    return view('buyer.home', compact('products'));
}
}
