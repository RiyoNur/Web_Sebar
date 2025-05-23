<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil produk dengan status 'verified'
        $products = Product::where('status', 'verified')->get();
        //dd($products);
        return view('home', compact('products'));
    }
}
