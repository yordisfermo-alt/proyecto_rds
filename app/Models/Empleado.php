<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;
    
    protected $table = 'empleados';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'fecha_ingreso',
        'salario',
        'estado',
        'id_cargo',
    ];

    // Relacion: un empleado pertenece a un cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }
    
}
