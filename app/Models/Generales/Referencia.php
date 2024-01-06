<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    protected $table = 'referencias';

    protected $fillable = [
        'referencia'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
