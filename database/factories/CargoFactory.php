<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    protected $model = Cargo::class;

    public function definition(): array
    {
        $cargos = [
            'Gerente General',
            'Supervisor de Area',
            'Analista Administrativo',
            'Auxiliar Contable',
            'Tecnico de Soporte',
            'Asesor Comercial',
            'Coordinador Logistico',
            'Asistente Administrativo',
        ];

        return [
            'nombre_cargo' => $this->faker->randomElement($cargos) . ' ' . $this->faker->unique()->numberBetween(1, 999),
            'descripcion' => 'Cargo encargado de apoyar la gestion y cumplir los objetivos del area asignada',
        ];
    }
}
