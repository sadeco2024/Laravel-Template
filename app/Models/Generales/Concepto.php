<?php

namespace App\Models\Generales;

use App\Models\Configuraciones\Menu;
use App\Models\Telcel\Canal;
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

    public static function obtenerConcepto($concepto)
    {
        return self::firstOrCreate(['concepto'=>$concepto]);
    }

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function tlcCanal()
    {
        return $this->belongsTo(Canal::class, 'tipo_concepto_id');
    }

}
