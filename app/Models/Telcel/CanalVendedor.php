<?php

namespace App\Models\Telcel;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class CanalVendedor extends Model
{
    use HasFactory;

    protected $table = 'tlc_canales_vendedores';

    protected $guarded = ['id'];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function canal()
    {
        return $this->belongsTo(Canal::class);
    }
   

 
}
