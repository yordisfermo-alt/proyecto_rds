<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cargo extends Model
{
    use HasFactory;
    
    protected $table = 'cargos';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_cargo',
        'descripcion',
    ];
// Relacion: un cargo tiene muchos empleados
    public function empleados()
    {
        return $this->hasMany (Empleado::class, 'id_cargo');
    }
// Relaciion: un cargo tiene muchas funciones
    public function funciones()
    {
        return $this->hasMany (FuncionesCargo::class, 'id_cargo');
    }

}
