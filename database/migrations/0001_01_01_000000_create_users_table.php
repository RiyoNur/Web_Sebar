<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamps();
        });

        // Menambahkan foreign key constraints yang mengarah ke tabel 'users'
        // Sebagai contoh, jika ada kolom 'user_id' di tabel lain
        // Anda bisa menambahkan foreign key di migrasi tabel lain misalnya 'products'
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    // Pastikan tabel 'products' ada sebelum mencoba menghapus foreign key
    if (Schema::hasTable('products')) {
        Schema::table('products', function (Blueprint $table) {
            // Pastikan foreign key 'user_id' ada sebelum dihapus
            if (Schema::hasColumn('products', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
        });
    }

    // Menghapus tabel 'products' jika ada
    Schema::dropIfExists('products');

    // Menghapus tabel 'users' dan tabel terkait lainnya
    Schema::dropIfExists('users');
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('sessions');
}

};
