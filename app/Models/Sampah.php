<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'jenis',
        'harga',
    ];

    // Relasi satu Sampah dapat memiliki banyak Setoran
    public function setoran()
    {
        return $this->hasMany(Setoran::class);
    }
}
