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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama admin
            $table->string('email')->unique(); // Email admin
            $table->string('password'); // Password admin
            $table->boolean('is_admin')->default(true); // Menandakan apakah admin adalah admin
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
