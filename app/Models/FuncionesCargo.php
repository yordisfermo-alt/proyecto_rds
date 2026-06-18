<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuncionesCargo extends Model
{
    use HasFactory;
    
    protected $table = 'funciones_cargo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion_funcion',
        'estado',
        'id_cargo',
    ];

    // Relacion: una funcion pertenece a un cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }
}
