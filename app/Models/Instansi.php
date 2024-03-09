<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi'; // Jika perlu menentukan nama tabel secara eksplisit

    protected $fillable = [
        'nama_instansi',
        'user_id',
        'admin_jaringan',
        'telepon',
        'mac_address',
        'latitude',
        'longitude',
        'role',
        'icon',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
}