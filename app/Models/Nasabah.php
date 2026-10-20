<?php

namespace App\Models;

use App\Models\Penarikan;
use App\Models\Setoran;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_induk',
        'nama',
        'alamat',
        'jumlah_orang_kk',
    ];

    // Relasi hasMany: Nasabah dapat memiliki banyak Setoran melalui kolom 'nama_nasabah' pada model Setoran
    public function setorans()
    {
        return $this->hasMany(Setoran::class, 'nama_nasabah', 'jenis_sampah');
    }

    // Relasi hasMany: Nasabah dapat memiliki banyak Penarikan. Relasi ini dihubungkan dengan id Nasabah.
    public function penarikans()
    {
        return $this->hasMany(Penarikan::class);
    }

    // Relasi belongsTo: Nasabah berhubungan dengan satu User melalui kolom user_id (secara default)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
