<?php

namespace App\Models\Erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloDiscreto extends Model
{
    use HasFactory;

    protected $table = 'articulos_discretos';

    protected $fillable = ['serie','long','tipo','articulo_id'];

    protected $hidden = ['created_at', 'updated_at'];


    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function iccids()
    {
        return $this->hasMany(ArticuloDiscreto::class);

    }

    public function imeis()
    {
        return $this->hasMany(ArticuloDiscreto::class);
    }

}
