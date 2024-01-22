<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curp extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'curp'
    ];       

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
