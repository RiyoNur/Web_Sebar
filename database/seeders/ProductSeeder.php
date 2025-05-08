<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Product::create([
            'nama_produk' => 'Furnitur Kamar Tidur',
            'harga' => 1500000,
            'foto' => 'furnitur_kamar_tidur.jpg',
            'deskripsi' => 'Furnitur kamar tidur yang nyaman dan elegan', // Menambahkan deskripsi
        ]);
    }

}
