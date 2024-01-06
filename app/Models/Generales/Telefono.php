<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    protected $fillable = [
        'telefono'
    ];     
    
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
