<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto', 'nama_produk', 'deskripsi', 'kondisi', 'harga', 'alamat', 'nomor_telepon', 'user_id','stok','category',
    ];
    public function ratings()
{
    return $this->hasMany(Rating::class);
}
}


