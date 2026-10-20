<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_name', 'price', 'quantity'];
    // Relasi CartItem berhubungan dengan Product melalui product_id
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // Relasi CartItem berhubungan dengan User, menggunakan user_id secara default
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

