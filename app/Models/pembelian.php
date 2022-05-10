<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class pembelian extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'id_pembeli', 'total', 'metode_pembayaran', 'status_pembayaran', 'barang_diterima'    
    ];
    protected $guarded = ['id'];
}
