<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'teknisi'; // Jika perlu menentukan nama tabel secara eksplisit

    protected $fillable = ['nama_teknisi', 'alamat', 'telepon', 'user_id','role'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}