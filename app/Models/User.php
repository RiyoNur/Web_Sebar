<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Pastikan menggunakan ini
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Jika menggunakan mass-assignment, pastikan atribut yang dapat diisi sudah didefinisikan
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // Tambahkan is_admin di sini
    ];


    // Jika tabel menggunakan nama yang berbeda, Anda bisa menambahkannya di sini
    protected $table = 'users';
}

