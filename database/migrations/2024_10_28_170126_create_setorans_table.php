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
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nama_nasabah')->constrained('nasabahs')->onDelete('cascade'); // ID Nasabah
            $table->foreignId('jenis_sampah')->constrained('sampahs')->onDelete('cascade'); // ID Jenis Sampah
            $table->date('tanggal'); 
            $table->decimal('setor', 10, 0); 
            $table->decimal('jumlah_setoran', 10, 0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
