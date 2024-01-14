<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = [
        'estado',
        'clave',
        'abreviatura'
    ];    

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function scopeNoRandom($query)
    {
        return $query->whereBetween('clave',[1,35]);
    }

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

    protected function estado(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucfirst($value),
        );
    }     
}    

