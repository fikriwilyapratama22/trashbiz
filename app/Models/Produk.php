<?php

namespace App\Models;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    
    protected $fillable = [
        'nama', 'deskripsi', 'harga', 
    ];

    // Relasi satu produk dapat memiliki banyak penjualan, dihubungkan dengan kolom 'produk' pada tabel Penjualan
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'produk'); // 'produk_id' adalah kolom di tabel penjualan
    }

    // Relasi satu produk dapat memiliki banyak item dalam keranjang belanja (cart)
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
