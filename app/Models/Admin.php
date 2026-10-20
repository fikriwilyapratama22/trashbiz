<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp_wa',
        'email',
        'jabatan',
        'password',
    ];

    // Kolom yang harus disembunyikan dari array
    protected $hidden = [
        'password', 
        'remember_token',
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
}
