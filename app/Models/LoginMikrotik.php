<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginMikrotik extends Model
{
    protected $fillable = ['ip','username','password'];
}
