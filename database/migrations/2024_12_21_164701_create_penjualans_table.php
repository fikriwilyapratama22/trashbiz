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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('pembeli'); 
            $table->date('tanggal');
            $table->string('produk')->constrained('produk')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->integer('banyak_barang');
            $table->string('no_telp', 15); 
            $table->text('alamat');
            $table->enum('metode_pembayaran', ['cod', 'transfer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
