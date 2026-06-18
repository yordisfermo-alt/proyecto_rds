<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\FuncionesCargo;
use Illuminate\Database\Seeder;

class FuncionesCargoSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = Cargo::all();
        $funciones = [
            'Planificar actividades del cargo',
            'Ejecutar tareas operativas asignadas',
            'Reportar avances y novedades',
            'Coordinar con otras areas de la empresa',
            'Cumplir politicas y procedimientos internos',
        ];

        foreach ($cargos as $cargo) {
            foreach ($funciones as $funcion) {
                FuncionesCargo::create([
                    'descripcion_funcion' => $funcion,
                    'estado' => true,
                    'id_cargo' => $cargo->id,
                ]);
            }
        }
    }
}
