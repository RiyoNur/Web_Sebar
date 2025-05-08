<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Pastikan ini ada
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable // Pastikan Admin memperluas Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super_admin', // Jika Anda memiliki kolom ini
    ];

    // Jika Anda ingin menambahkan pengaturan tambahan, lakukan di sini
}
