<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition(): array
    {
        $nombres = [
            'Juan',
            'Carlos',
            'Luis',
            'Andres',
            'Miguel',
            'Jorge',
            'Santiago',
            'Felipe',
            'Daniel',
            'Alejandro',
            'Maria',
            'Ana',
            'Laura',
            'Sofia',
            'Paula',
            'Camila',
            'Valentina',
            'Diana',
            'Carolina',
            'Natalia',
        ];

        $apellidos = [
            'Garcia',
            'Rodriguez',
            'Martinez',
            'Lopez',
            'Gonzalez',
            'Perez',
            'Sanchez',
            'Ramirez',
            'Torres',
            'Vargas',
            'Castro',
            'Moreno',
            'Rojas',
            'Herrera',
            'Mendoza',
            'Jimenez',
            'Ruiz',
            'Ortiz',
            'Navarro',
            'Cortes',
        ];

        return [
            'nombres' => $this->faker->randomElement($nombres),
            'apellidos' => $this->faker->randomElement($apellidos),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'fecha_ingreso' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'salario' => $this->faker->numberBetween(1500000, 8000000),
            'estado' => $this->faker->boolean(90),
            'id_cargo' => Cargo::factory(),
        ];
    }
}
