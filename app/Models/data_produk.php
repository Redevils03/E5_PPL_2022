<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class data_produk extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'gambar', 'nama_produk', 'jumlah_produk', 'harga_produk', 'harga_asli'    
    ];
    protected $guarded = ['No_id'];
}
