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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama_produk');
            $table->text('deskripsi')->nullable(); // Menjadikan kolom deskripsi nullable
            $table->string('kondisi');
            $table->decimal('harga', 10, 2);
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bukti_transfer')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
