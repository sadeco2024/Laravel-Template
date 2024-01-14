<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;

    protected $table = 'estatuses';

    protected $fillable = [
        'estatus'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function estatus(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value)
        );
    }
}
