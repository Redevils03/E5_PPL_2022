<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class chat_message extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'id_pembeli', 'role', 'message',   
    ];
}
