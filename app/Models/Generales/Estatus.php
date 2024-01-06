<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;

    protected $table = 'estatuses';

    protected $fillable = [
        'estatus'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
