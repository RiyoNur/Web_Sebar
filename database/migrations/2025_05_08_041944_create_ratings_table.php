<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->unsignedTinyInteger('rating'); // nilai 1–5
        $table->text('comment')->nullable();
        $table->timestamps();
    });
}
};
