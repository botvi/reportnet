<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = ['gambar','deskripsi_title', 'deskripsi', 'user_id','status','solusi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
