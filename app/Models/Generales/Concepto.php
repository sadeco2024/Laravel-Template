<?php

namespace App\Models\Generales;

use App\Models\Configuraciones\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Concepto extends Model
{
    use HasFactory;

    protected $table = 'conceptos';

    protected $fillable = [
        'concepto',
    ];




    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
