<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class detail_pembelian extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'id_pembelian', 'id_produk', 'nama_produk', 'harga', 'jumlah', 'total'    
    ];

    
}
