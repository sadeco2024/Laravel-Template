<?php

// namespace App\Models\Rh;

// use Illuminate\Database\Eloquent\Casts\Attribute;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Puesto extends Model
// {
//     use HasFactory;

//     protected $table = 'rh_puestos';

//     protected $fillable = [
//         'descripcion'
//     ];


//     protected $withCount = [
//         'empleados'
//     ];

//     protected $casts = [
//         'puesto' => 'string',
//     ];

//     // quiero saber el total de empleados que hay por cada puesto, la relación es que en empleados es el campo "puesto_rh_extra_id" y aquí es el campo id

//     public function empleadosPorPuesto($concepto)
//     {
//         return $this->hasMany(Empleado::class)
//             ->whereIn('puesto_rh_extra_id', $concepto);
//     }



//     protected function puesto(): Attribute
//     {
//         return Attribute::make(
//             get: fn (string $value) => ucwords($value),
//             set: fn (string $value) => strtolower($value)
//         );
//     }

//     public function scopeWithEmpleadosCount($query)
//     {
//         return $query->withCount('empleados');
//     }



//     protected $hidden = [
//         'created_at',
//         'updated_at',
//     ];
}
