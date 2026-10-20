<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jumlah',
        'status',
    ];

    // Relasi belongsTo: Penarikan berhubungan dengan satu User melalui kolom user_id
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
