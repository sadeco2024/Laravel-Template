<?php

namespace App\Models\Generales;

use App\Models\telcel\Activacion;
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

    public function activaciones()
    {
        return $this->hasMany(Activacion::class);
    }

    public static function obtenerTelefono($telefono)
    {
        // TODO: Validar que sea 10 dígitos.
        return self::firstOrCreate(['telefono'=>$telefono]);
    }
}
