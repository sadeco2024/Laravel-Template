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

}
