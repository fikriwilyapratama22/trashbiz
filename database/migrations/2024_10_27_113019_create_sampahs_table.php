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
        Schema::create('sampahs', function (Blueprint $table) {
            $table->id(); // Kolom untuk ID
            $table->string('gambar'); // Kolom untuk menyimpan nama file gambar
            $table->string('jenis', 255); // Kolom untuk jenis sampah (panjang 255 karakter)
            $table->decimal('harga', 10,0); // Kolom untuk harga sampah
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampahs');
    }
};
