<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class informasi_mitra extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'alamat', 'no_telepon', 'deskripsi'    
    ];
    protected $guarded = ['id'];
}
