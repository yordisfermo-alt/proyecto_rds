<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\FuncionesCargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionesCargoFactory extends Factory
{
    protected $model = FuncionesCargo::class;

    public function definition(): array
    {
        $funciones = [
            'Dirigir el equipo de trabajo',
            'Tomar decisiones estrategicas',
            'Supervisar proyectos asignados',
            'Reportar avances a la direccion',
            'Asignar tareas al personal',
            'Evaluar el desempeno del equipo',
            'Resolver novedades del area',
            'Capacitar empleados',
            'Revisar documentacion interna',
            'Presentar reportes mensuales',
        ];

        return [
            'descripcion_funcion' => $this->faker->randomElement($funciones),
            'estado' => $this->faker->boolean(85),
            'id_cargo' => Cargo::factory(),
        ];
    }
}
