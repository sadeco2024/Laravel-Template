<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    use HasFactory;

    protected $table = 'correos';

    protected $fillable = [
        'correo',
        'valid'
    ];

    protected $hidden = [
        'send_info',
        'send_news',
        'send_promotions',

        'created_at',
        'updated_at'
    ];
}
