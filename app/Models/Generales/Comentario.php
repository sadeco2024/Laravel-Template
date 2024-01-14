<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = [
        'comentario',      
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',      
    ];

}
