<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembeli',
        'tanggal',
        'produk',
        'price',
        'no_telp',
        'alamat',
        'metode_pembayaran',
        'banyak_barang',
        'user_id',
    ];

    // Relasi belongsTo: Penjualan berhubungan dengan satu Produk melalui kolom 'produk'
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk');
    }
}
