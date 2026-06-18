<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = Cargo::all();

        Empleado::factory(30)->create([
            'id_cargo' => fn () => $cargos->random()->id,
        ]);
    }
}
