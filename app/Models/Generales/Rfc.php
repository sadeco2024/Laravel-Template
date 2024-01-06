<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfc extends Model
{
    use HasFactory;

    protected $table = 'rfcs';

    protected $fillable = [
        'rfc'
    ];        
}
