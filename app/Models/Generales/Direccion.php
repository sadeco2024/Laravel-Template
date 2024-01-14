<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        "calle",
        "numero_exterior",
        "numero_interior",
        "colonia",
        "codigo_postal",
        "ciudad_id",
        "estado_id",
        "municipio_id",
        "referencia_id"        
    ];

    protected $hidden = [
        "ciudad_id",
        "estado_id",
        "municipio_id",
        "referencia_id",
        'created_at',
        'updated_at'
    ];

    protected $with = ['ciudad', 'estado', 'municipio', 'referencia'];


    public function ciudad()
    {
        return $this->belongsTo('App\Models\Generales\Ciudad', 'ciudad_id');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Generales\Estado', 'estado_id');
    }
    public function municipio()
    {
        return $this->belongsTo('App\Models\Generales\Municipio', 'municipio_id');
    }   
    public function referencia()
    {
        return $this->belongsTo('App\Models\Generales\Referencia', 'referencia_id');
    }   

    protected function calle(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }
    protected function colonia(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }





}
