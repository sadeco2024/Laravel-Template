<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = 'municipios';

    protected $fillable = [
        'municipio',
        'clave',
        'abreviatura',
        'estado_id',
    ];

    protected $hidden = [
        'ciudad_id',
        // 'estado_id',        
        'created_at',
        'updated_at'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    protected function municipio(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value),
        );
    }
}
