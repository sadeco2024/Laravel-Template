<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nombre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'primer_nombre',
        'segundo_nombre',
        'paterno',
        'materno',
        'curp_id'
    ];    

    public function curp()
    {
        return $this->belongsTo(Curp::class);
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->primer_nombre . ' ' . $this->segundo_nombre . ' ' . $this->paterno . ' ' . $this->materno;
    }

    protected $with = [
        'curp'
    ];


    protected $casts = [
        'nombre' => 'string',
        'primer_nombre' => 'string',
        'segundo_nombre' => 'string',
        'paterno' => 'string',
        'materno' => 'string',
        'curp_id' => 'integer'
    ];

    protected $hidden = [
        'id',
        'curp_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
        );
    }        
}
